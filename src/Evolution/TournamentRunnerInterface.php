<?php
namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;

interface TournamentRunnerInterface
{
    public function runTournament(TournamentRun $tournamentRun): TournamentRunResultInterface;
}