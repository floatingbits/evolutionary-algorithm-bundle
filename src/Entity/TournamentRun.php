<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


class TournamentRun
{
    private ?int $id = null;

    private ?TournamentConfiguration $tournamentConfiguration = null;

    private ?ProblemInstance $problemInstance = null;

    private ?string $serializedSpecimens = null;

    private ?TournamentRun $previousRun = null;

    private float $bestRating = 0;


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

    /**
     * @return string|null
     */
    public function getSerializedSpecimens(): ?string
    {
        return $this->serializedSpecimens;
    }

    /**
     * @param string|null $serializedSpecimens
     */
    public function setSerializedSpecimens(?string $serializedSpecimens): void
    {
        $this->serializedSpecimens = $serializedSpecimens;
    }

    /**
     * @return TournamentRun|null
     */
    public function getPreviousRun(): ?TournamentRun
    {
        return $this->previousRun;
    }

    /**
     * @param TournamentRun|null $previousRun
     */
    public function setPreviousRun(?TournamentRun $previousRun): void
    {
        $this->previousRun = $previousRun;
    }

    /**
     * @return float|int
     */
    public function getBestRating(): float|int
    {
        return $this->bestRating;
    }

    /**
     * @param float|int $bestRating
     */
    public function setBestRating(float|int $bestRating): void
    {
        $this->bestRating = $bestRating;
    }



}
