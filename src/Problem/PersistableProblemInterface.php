<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Problem;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;

interface PersistableProblemInterface
{
    /**
     * @return ProblemInstance
     */
    public function getProblemInstanceEntity(): ProblemInstance;

    /**
     * @param ProblemInstance $problemInstanceEntity
     */
    public function setProblemInstanceEntity(ProblemInstance $problemInstanceEntity): void;

    public function getFormClass(): string;

}