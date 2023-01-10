<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Evolution;


use FloatingBits\EvolutionaryAlgorithm\Evolution\TournamentInterface;

interface ConfigurableTournamentInterface extends \Stringable
{

    public function configureTournament(TournamentInterface $tournament): void;
    public function getTournamentClass(): string;
    public function getFormClass(): string;
    public function getNumRounds(): int;
    public function getNumSpecimen(): int;

}