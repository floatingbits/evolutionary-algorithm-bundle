<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;

interface TournamentRunResultInterface
{
    public function getSpecimenCollection(): SpecimenCollection;
    public function getNumRounds(): int;
}