<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution\Provider;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\ConfigurableDefaultTournament;

class DefaultTournamentProvider implements ConfigurableTournamentProviderInterface
{
    /**
     * @return TournamentType[]
     */
    public function getConfigurableTournaments(): array
    {
        $tournament1 = new TournamentType();
        $tournament1->setInstanceClass(ConfigurableDefaultTournament::class);
        $tournament1->setName('default tournament');
        $tournament1->setDescription(
            'A default Tournament with simple parameters: num rounds, num rounds before cleanup, num specimen');
        return [
            $tournament1
        ];
    }


}