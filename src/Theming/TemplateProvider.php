<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Theming;

use Symfony\Component\String\UnicodeString;
use Twig\Environment;

class TemplateProvider
{
    /** @var ThemeInterface[] */
    private array $themes = [];
    /** @var ThemeInterface[] */
    private array $orderedSubThemes = [];
    private array $classTemplateMap = [];
    private Environment $twigEnvironment;

    /**
     * @param string $templatePath
     * @param string $theme
     * @param array $classTemplateMap
     * @param Environment $twigEnvironment
     */
    public function __construct(array $classTemplateMap, Environment $twigEnvironment) {

        $this->classTemplateMap = $classTemplateMap;
        $this->twigEnvironment = $twigEnvironment;
    }

    public function addTheme(ThemeInterface $theme) {
        $this->themes[] = $theme;
        $this->rebuildOrderedSubThemes();
    }

    private function rebuildOrderedSubThemes() {
        usort($this->themes, function(ThemeInterface $a, ThemeInterface $b) {
            return $b->getPriority() <=> $a->getPriority();
        });
        $this->orderedSubThemes = [];
        foreach ($this->themes as $theme) {
            $currentTheme = $theme;
            while ($currentTheme) {
                $this->orderedSubThemes[] = $currentTheme;
                $currentTheme = $currentTheme->getParentTheme();
            }
        }
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
        foreach ($this->orderedSubThemes as $themeCandidate) {
            try {
                if ($templatePath = $this->getFullPath($themeCandidate, $this->getTemplate($themeCandidate, $object, $subFolder))) {
                    return $templatePath;
                }
            }
            catch (TemplateNotFoundException $e) {
                //just try another theme as long as there are candidates left.
            }
        }
        return '';

    }

    /**
     * @param $templatePath
     * @return string
     */
    private function getFullPath(ThemeInterface $theme, $templatePath): string {
        return $theme->getPath() . '/' . $templatePath;
    }

    /**
     * @param mixed $object
     * @param string $classSubFolder
     * @param int $useParentClassGeneration
     * @return string
     * @throws TemplateNotFoundException
     */
    private function getTemplate(ThemeInterface $theme, mixed $object, string $classSubFolder, int $useParentClassGeneration = 0): string {
        try {
            $reflectionClass = $this->getParentClassForObject($object, $useParentClassGeneration);
        }
        catch (\ReflectionException $e) {
            $reflectionClass = null;
        }
        if (!$reflectionClass) {
            throw new TemplateNotFoundException('Couldnt find template for object of class ' . get_class($object));
        }
        $templatePath =  $reflectionClass ? ($this->classTemplateMap[$reflectionClass->getName()] ??
            $classSubFolder . '/'. $this->getShortClassName($reflectionClass) . '.html.twig') : null;

        if ($this->twigEnvironment->getLoader()->exists($this->getFullPath($theme, $templatePath))) {
            return $templatePath;
        }
        else {
            $useParentClassGeneration++;
            return $this->getTemplate($theme, $object, $classSubFolder, $useParentClassGeneration);
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
        return $reflectionClass instanceof \ReflectionClass ? $reflectionClass : null;
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