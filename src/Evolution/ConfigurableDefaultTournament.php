<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evolution\DefaultTournament;
use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverInterface;
use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Floatingbits\EvolutionaryAlgorithmBundle\Form\ConfigurableDefaultTournamentType;

class ConfigurableDefaultTournament  implements ConfigurableTournamentInterface
{
    /** @var int  */
    private int $numRounds;
    /** @var int  */
    private int $cleanupAfterNRounds;
    /** @var int  */
    private int $numSpecimen = 50;

    /**
     * @return int
     */
    public function getNumRounds(): int
    {
        return $this->numRounds;
    }

    /**
     * @param int $numRounds
     */
    public function setNumRounds(int $numRounds): void
    {
        $this->numRounds = $numRounds;
    }

    /**
     * @return int
     */
    public function getCleanupAfterNRounds(): int
    {
        return $this->cleanupAfterNRounds;
    }

    /**
     * @param int $cleanupAfterNRounds
     */
    public function setCleanupAfterNRounds(int $cleanupAfterNRounds): void
    {
        $this->cleanupAfterNRounds = $cleanupAfterNRounds;
    }

    /**
     * @return int
     */
    public function getNumSpecimen(): int
    {
        return $this->numSpecimen;
    }

    /**
     * @param int $numSpecimen
     */
    public function setNumSpecimen(int $numSpecimen): void
    {
        $this->numSpecimen = $numSpecimen;
    }


    /**
     * @param DefaultTournament $tournament
     * @return void
     * @throws \Exception
     */
    public function configureTournament(TournamentInterface $tournament): void {
        if ($tournament instanceof DefaultTournament ) {
            $tournament->setCleanupAfterNRounds($this->cleanupAfterNRounds);
            $tournament->setNumRounds($this->numRounds);
        }
        else {
            throw new \Exception(sprintf('Wrong class %s instead of %s', get_class($tournament), $this->getTournamentClass()));
        }

    }
    public function getTournamentClass(): string
    {
        return DefaultTournament::class;
    }
    public function getFormClass(): string
    {
        return ConfigurableDefaultTournamentType::class;
    }
    public function __toString(): string
    {
        return join(', ', [
            sprintf('Number of rounds: %s', $this->getNumRounds()),
            sprintf('Cleanup after num rounds: %s', $this->getCleanupAfterNRounds())
        ]);
    }
}