<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection\Compiler;

use Floatingbits\EvolutionaryAlgorithmBundle\Command\SyncProblemsCommand;
use Floatingbits\EvolutionaryAlgorithmBundle\Command\SyncTournamentTypesCommand;
use Floatingbits\EvolutionaryAlgorithmBundle\Theming\TemplateProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ThemePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(TemplateProvider::class)) {
            $definition = $container->findDefinition(TemplateProvider::class);

            $taggedTournamentProviders = $container->findTaggedServiceIds('evolutionary_algorithm.theme');

            foreach ($taggedTournamentProviders as $id => $tags) {
                // add the transport service to the TransportChain service
                $definition->addMethodCall('addTheme', [new Reference($id)]);
            }
        }

    }

}