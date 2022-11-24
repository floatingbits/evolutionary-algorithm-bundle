<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;


use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;
use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;

interface ConfigurableTournamentInterface extends \Stringable
{

    public function configureTournament(TournamentInterface $tournament): void;
    public function getTournamentClass(): string;
    public function getFormClass(): string;

}