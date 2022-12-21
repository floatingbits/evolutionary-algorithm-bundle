<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\Problem;

interface PersistableProblemProviderInterface
{
    /**
     * @return Problem[]
     */
    public function getPersistableProblems(): array;
}