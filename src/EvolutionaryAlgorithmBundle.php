<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle;

use Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection\Compiler\SyncCommandsPass;
use Floatingbits\EvolutionaryAlgorithmBundle\DependencyInjection\Compiler\TwigPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvolutionaryAlgorithmBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new SyncCommandsPass());
    }
}