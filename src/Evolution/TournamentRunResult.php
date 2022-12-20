<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

class TournamentRunResult implements TournamentRunResultInterface
{
    private ?SpecimenCollection $specimenCollection;
    private int $numRounds = 0;
    public function __construct(SpecimenCollection $specimenCollection, int $numRounds) {
        $this->numRounds = $numRounds;
        $this->specimenCollection = $specimenCollection;
    }
    /**
     * @return mixed
     */
    public function getSpecimenCollection():SpecimenCollection
    {
        return $this->specimenCollection;
    }

    /**
     * @param mixed $specimenCollection
     */
    public function setSpecimenCollection($specimenCollection): void
    {
        $this->specimenCollection = $specimenCollection;
    }

    /**
     * @return mixed
     */
    public function getNumRounds(): int
    {
        return $this->numRounds;
    }

    /**
     * @param mixed $numRounds
     */
    public function setNumRounds($numRounds): void
    {
        $this->numRounds = $numRounds;
    }

}