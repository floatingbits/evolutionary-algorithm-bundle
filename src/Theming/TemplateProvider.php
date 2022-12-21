<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Theming;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Symfony\Component\String\UnicodeString;
use Twig\Environment;

class TemplateProvider
{
    private string $templatePath = '';
    private string $theme = '';
    private array $classTemplateMap = [];
    private Environment $twigEnvironment;

    public function __construct(string $templatePath, string $theme, array $classTemplateMap, Environment $twigEnvironment) {
        $this->templatePath = $templatePath;
        $this->theme = $theme;
        $this->classTemplateMap = $classTemplateMap;
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @param mixed $object
     * @param string|null $subFolder
     * @return string
     * @throws TemplateNotFoundException
     */
    public function getTemplateForObject(mixed $object,?string $subFolder = null): string {
        if (!$subFolder) {
            $subFolder = $this->guessSubfolder($object);
        }
        return $this->getFullPath( $this->getTemplate($object, $subFolder));
    }

    /**
     * @param $templatePath
     * @return string
     */
    private function getFullPath($templatePath): string {
        return $this->getThemePath() . '/' . $templatePath;
    }

    /**
     * @return string
     */
    private function getThemePath(): string {
        return $this->templatePath . '/' . $this->theme;
    }

    /**
     * @param mixed $object
     * @param string $folder
     * @param int $useParentClassGeneration
     * @return string
     * @throws TemplateNotFoundException
     */
    private function getTemplate(mixed $object,string $folder,int $useParentClassGeneration = 0): string {
        try {
            $reflectionClass = $this->getParentClassForObject($object, $useParentClassGeneration);
        }
        catch (\ReflectionException $e) {
            $reflectionClass = null;
        }
        if (!$reflectionClass) {
            throw new TemplateNotFoundException('Couldnt find template for object of class ' . get_class($object));
        }
        $template = $this->classTemplateMap[$reflectionClass->getName()] ??
            $folder . '/'. $this->getShortClassName($reflectionClass) . '.html.twig';

        if ($this->twigEnvironment->getLoader()->exists($this->getFullPath($template))) {
            return $template;
        }
        else {
            $useParentClassGeneration++;
            return $this->getTemplate($object, $folder, $useParentClassGeneration);
        }
    }

    /**
     * @param $object
     * @param $useParentClassGeneration
     * @return \ReflectionClass|null
     * @throws \ReflectionException
     */
    private function getParentClassForObject($object, $useParentClassGeneration):?\ReflectionClass {
        $reflectionClass = new \ReflectionClass($object);
        while ($useParentClassGeneration--) {
            $reflectionClass = $reflectionClass->getParentClass();
        }
        return $reflectionClass ?? null;
    }

    /**
     * @param $object
     * @return UnicodeString
     */
    private function guessSubfolder($object): UnicodeString {
        $path = explode('\\', get_class($object));
        array_pop($path);
        $string = new UnicodeString(array_pop($path));
        return $string->snake();
    }

    /**
     * @param \ReflectionClass $reflectionClass
     * @return UnicodeString
     */
    private function getShortClassName(\ReflectionClass $reflectionClass): UnicodeString {
        $shortName =  $reflectionClass->getShortName();
        $string = new UnicodeString($shortName);
        return $string->snake();
    }
}