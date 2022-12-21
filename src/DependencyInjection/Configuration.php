<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('evolutionary_algorithm');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('templating')
            ->children()
                ->scalarNode('template_path')->end()
                ->scalarNode('theme')->end()
                ->arrayNode('class_map')
                    ->useAttributeAsKey('class')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
            ->end() // templating
            ->end()
        ;

        return $treeBuilder;
    }
}