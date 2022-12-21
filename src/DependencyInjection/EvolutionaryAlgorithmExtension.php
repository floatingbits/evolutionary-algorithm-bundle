<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvolutionaryAlgorithmExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources/config')
        );
        $loader->load('services.yaml');
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('Floatingbits\EvolutionaryAlgorithmBundle\Theming\TemplateProvider');
        if (isset($config['templating']['template_path'])) {
            $definition->replaceArgument(0, $config['templating']['template_path']);
        }
        if (isset($config['templating']['theme'])) {
            $definition->replaceArgument(1, $config['templating']['theme']);
        }
        if (isset($config['templating']['class_map'])) {
            $definition->replaceArgument(2, $config['templating']['class_map']);
        }

    }
}