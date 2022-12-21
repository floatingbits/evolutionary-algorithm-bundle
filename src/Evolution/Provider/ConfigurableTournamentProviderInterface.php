<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution\Provider;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;

interface ConfigurableTournamentProviderInterface
{
    /**
     * @return TournamentType[]
     */
    public function getConfigurableTournaments(): array;
}