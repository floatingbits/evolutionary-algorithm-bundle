<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;

use FloatingBits\EvolutionaryAlgorithm\Evolution\DefaultTournament;
use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverInterface;
use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;

class ConfigurableDefaultTournament extends DefaultTournament implements ConfigurableTournamentInterface
{
    /** @var TournamentConfiguration */
    private $tournamentConfigurationInstance;
    public function getTournamentConfigurationEntity(): TournamentConfiguration
    {
        $this->tournamentConfigurationInstance->setSerializedConfiguration(serialize($this->getSerializable()));
        return $this->tournamentConfigurationInstance;
    }

    public function setTournamentConfigurationEntity(TournamentConfiguration $tournamentConfigurationEntity): void
    {
        $this->tournamentConfigurationInstance = $tournamentConfigurationEntity;
        $this->setSerializable(unserialize($this->tournamentConfigurationInstance->getSerializedConfiguration()));
    }
    private function setSerializable($config) {
        $this->setNumRounds($config['numRounds']);
        $this->setCleanupAfterNRounds($config['cleanupAfterNRounds']);
    }
    private function getSerializable() {
        return [
            'cleanupAfterNRounds' => $this->getCleanupAfterNRounds(),
            'numRounds' => $this->getNumRounds(),
        ];
    }

    public function getFormClass(): string
    {
        // TODO: Implement getFormClass() method.
    }
}