<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Command;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\Problem;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\Provider\ConfigurableTournamentProviderInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemProviderInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\ProblemRepository;
use Floatingbits\EvolutionaryAlgorithmBundle\Repository\TournamentTypeRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;


class SyncProblemsCommand extends Command
{
    protected static $defaultDescription = 'Syncs detected evolutionary algorithm problem classes with the database.';
    /**
     * @var PersistableProblemProviderInterface[]
     */
    private array $problemProviders;


    private ProblemRepository $problemRepository;


    public function __construct(ProblemRepository $problemRepository)
    {
        parent::__construct();
        $this->problemRepository = $problemRepository;
    }

    public function addProblemProvider(PersistableProblemProviderInterface $problemProvider) {
        $this->problemProviders[] = $problemProvider;
    }



    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var PersistableProblemProviderInterface $problemProvider */
        foreach ($this->problemProviders as $problemProvider) {
            $persistableProblemClasses = $problemProvider->getPersistableProblems();
            foreach ($persistableProblemClasses as $problem) {
                $problemEntity = $this->problemRepository->findBy(['instanceClass' => $problem->getInstanceClass()]);
                if (!$problemEntity) {
                    $output->writeln(sprintf('Adding new problem %s', $problem->getName()));
                    $this->problemRepository->save($problem, true);
                }
            }
        }


        return Command::SUCCESS;

    }

}