<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


class TournamentRun
{
    private ?int $id = null;

    private ?TournamentConfiguration $tournamentConfiguration = null;

    private ?ProblemInstance $problemInstance = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ProblemInstance|null
     */
    public function getProblemInstance(): ?ProblemInstance
    {
        return $this->problemInstance;
    }

    /**
     * @param ProblemInstance|null $problemInstance
     */
    public function setProblemInstance(?ProblemInstance $problemInstance): void
    {
        $this->problemInstance = $problemInstance;
    }


    /**
     * @return TournamentConfiguration|null
     */
    public function getTournamentConfiguration(): ?TournamentConfiguration
    {
        return $this->tournamentConfiguration;
    }

    /**
     * @param TournamentConfiguration|null $tournamentConfiguration
     */
    public function setTournamentConfiguration(?TournamentConfiguration $tournamentConfiguration): void
    {
        $this->tournamentConfiguration = $tournamentConfiguration;
    }

}
