<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\AssignJobToMachinesEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use FloatingBits\EvolutionaryAlgorithm\Problem\ProblemInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\Example\AssignJobToMachinesExample\PersistableProblem;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;

class TournamentRunner implements TournamentRunnerInterface
{
    public function runTournament(TournamentRun $tournamentRun): SpecimenCollection
    {
        $problem = $tournamentRun->getProblemInstance()->getProblem();
        /** @var PersistableProblemInterface&ProblemInterface $persistableProblem */
        $persistableProblem = new ($problem->getInstanceClass())();
        $persistableProblem->setProblemInstanceEntity($tournamentRun->getProblemInstance());
        if ($persistableProblem instanceof PersistableProblem) {
            $persistableProblem->setJobs([
                new Job(32),
                new Job(44),
                new Job(52),
                new Job(40),
                new Job(10.1),
                new Job(31),
                new Job(19),
                new Job(31),
                new Job(52),
                new Job(40),
                new Job(10.1),
                new Job(31),
                new Job(19),
                new Job(31),
                new Job(52),
                new Job(40),
                new Job(10.1),
                new Job(31),
                new Job(19),
                new Job(31),
            ]);
        }

        $factory = $persistableProblem->getEvolverFactory();
        $evolver = $factory->createEvolver();

        $tournamentConfiguration = $tournamentRun->getTournamentConfiguration()->getConfigurableTournament();
        $numberOfSpecimen = 50;
        if ($tournamentConfiguration instanceof ConfigurableTournamentInterface) {
            $tournament = new ($tournamentConfiguration->getTournamentClass())();
            $tournamentConfiguration->configureTournament($tournament);
        }
        if ($tournament instanceof TournamentInterface) {
            $specimenGenerator = $persistableProblem->getSpecimenGenerator();
            $specimenCollection = $specimenGenerator->generateSpecimen($numberOfSpecimen);
            $tournament->setEvolver($evolver);
            $tournament->setSpecimenCollection($specimenCollection);
            $tournament->runTournament();
            return $tournament->getSpecimenCollection();
        }

    }

}