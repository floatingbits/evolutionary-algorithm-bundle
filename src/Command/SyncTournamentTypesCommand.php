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


class SyncTournamentTypesCommand extends Command
{
    protected static $defaultDescription = 'Syncs detected evolutionary algorithm tournament type classes with the database.';

    /**
     * @var ConfigurableTournamentProviderInterface[]
     */
    private array $tournamentProviders;


    private TournamentTypeRepository $tournamentTypeRepository;

    public function __construct(TournamentTypeRepository $tournamentTypeRepository)
    {
        parent::__construct();

        $this->tournamentTypeRepository = $tournamentTypeRepository;
    }


    public function addTournamentProvider(ConfigurableTournamentProviderInterface $tournamentProvider) {
        $this->tournamentProviders[] = $tournamentProvider;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        foreach ($this->tournamentProviders as $tournamentProvider) {
            $configurableTournaments = $tournamentProvider->getConfigurableTournaments();
            foreach ($configurableTournaments as $tournamentType) {
                $tournamentEntity = $this->tournamentTypeRepository->findBy(['instanceClass' => $tournamentType->getInstanceClass()]);
                if (!$tournamentEntity) {
                    $output->writeln(sprintf('Adding new tournament type %s', $tournamentType->getName()));
                    $this->tournamentTypeRepository->save($tournamentType, true);
                }
            }
        }

        return Command::SUCCESS;

    }

}