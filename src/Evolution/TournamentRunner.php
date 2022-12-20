<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;

use FloatingBits\EvolutionaryAlgorithm\Problem\ProblemInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;

class TournamentRunner implements TournamentRunnerInterface
{
    public function runTournament(TournamentRun $tournamentRun): TournamentRunResultInterface
    {
        /** @var PersistableProblemInterface&ProblemInterface $persistableProblem */
        $persistableProblem = $tournamentRun->getProblemInstance()->getPersistableProblem();


        $factory = $persistableProblem->getEvolverFactory();
        $evolver = $factory->createEvolver();

        $tournamentConfiguration = $tournamentRun->getTournamentConfiguration()->getConfigurableTournament();
        $numberOfSpecimen = 50;
        if ($tournamentConfiguration instanceof ConfigurableTournamentInterface) {
            $tournament = new ($tournamentConfiguration->getTournamentClass())();
            $tournamentConfiguration->configureTournament($tournament);
        }
        else {
            /** @todo Handle exception */
        }
        if ($tournament instanceof TournamentInterface) {
            if (!$specimenCollection = $tournamentRun->getSpecimenCollection()) {
                $specimenGenerator = $persistableProblem->getSpecimenGenerator();
                $specimenCollection = $specimenGenerator->generateSpecimen($numberOfSpecimen);
            }
            $tournament->setSpecimenCollection($specimenCollection);

            $tournament->setEvolver($evolver);
            $tournament->runTournament();
            return new TournamentRunResult($tournament->getSpecimenCollection(), $tournamentConfiguration->getNumRounds());
        }

    }

}