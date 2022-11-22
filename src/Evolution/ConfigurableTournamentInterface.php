<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;


use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;

interface ConfigurableTournamentInterface
{
    /**
     * @return TournamentConfiguration
     */
    public function getTournamentConfigurationEntity(): TournamentConfiguration;

    /**
     * @param TournamentConfiguration $tournamentConfigurationEntity
     */
    public function setTournamentConfigurationEntity(TournamentConfiguration $tournamentConfigurationEntity): void;

    public function getFormClass(): string;

}