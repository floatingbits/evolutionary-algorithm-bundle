<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection\Compiler;

use Floatingbits\EvolutionaryAlgorithmBundle\Command\SyncProblemsCommand;
use Floatingbits\EvolutionaryAlgorithmBundle\Command\SyncTournamentTypesCommand;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SyncCommandsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(SyncTournamentTypesCommand::class)) {
            $definition = $container->findDefinition(SyncTournamentTypesCommand::class);

            $taggedTournamentProviders = $container->findTaggedServiceIds('evolutionary_algorithm.tournament_provider');

            foreach ($taggedTournamentProviders as $id => $tags) {
                // add the transport service to the TransportChain service
                $definition->addMethodCall('addTournamentProvider', [new Reference($id)]);
            }
        }
        if ($container->has(SyncProblemsCommand::class)) {
            $definition = $container->findDefinition(SyncProblemsCommand::class);
            $taggedProblemProviders = $container->findTaggedServiceIds('evolutionary_algorithm.problem_provider');

            foreach ($taggedProblemProviders as $id => $tags) {
                // add the transport service to the TransportChain service
                $definition->addMethodCall('addProblemProvider', [new Reference($id)]);
            }
        }
    }

}