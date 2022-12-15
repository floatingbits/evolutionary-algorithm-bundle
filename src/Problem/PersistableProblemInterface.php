<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;

interface PersistableProblemInterface
{

    public function getFormClass(): string;
    public function getFormTemplate(): string;

}