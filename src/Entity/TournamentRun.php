<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SortableGenotypeInterface;

class TournamentRun
{
    private ?int $id = null;

    private ?TournamentConfiguration $tournamentConfiguration = null;

    private ?ProblemInstance $problemInstance = null;

    private ?string $serializedSpecimens = null;

    private ?TournamentRun $previousRun = null;

    private float $bestRating = 0;

    private int $cumulatedNumRounds = 0;

    private ?SpecimenCollection $specimenCollection = null;

    /**
     * @return int
     */
    public function getCumulatedNumRounds(): int
    {
        return $this->cumulatedNumRounds;
    }

    /**
     * @param int $cumulatedNumRounds
     */
    public function setCumulatedNumRounds(int $cumulatedNumRounds): void
    {
        $this->cumulatedNumRounds = $cumulatedNumRounds;
    }



    /**
     * @return SpecimenCollection|null
     */
    public function getSpecimenCollection(): ?SpecimenCollection
    {
        $specimenCollection = null;
        if (!$this->specimenCollection) {
            $specimenCollection = unserialize($this->serializedSpecimens);
        }
        if ($specimenCollection instanceof SpecimenCollection) {
            $this->specimenCollection = $specimenCollection;
        }
        return $this->specimenCollection;
    }

    public function getSortedSpecimenCollection(): ?SpecimenCollection
    {
        $specimenCollection = $this->getSpecimenCollection();
        if ($specimenCollection) {
            $specimenCollection->sortByFitness(function(SpecimenInterface $a, SpecimenInterface $b) {
                if ($a->getGenotype() instanceof SortableGenotypeInterface && $b->getGenotype() instanceof SortableGenotypeInterface) {
                    return $a->getGenotype()->getComparableString() > $b->getGenotype()->getComparableString();
                }

                return 0;
            });
            return $specimenCollection;
        }
        return null;
    }

    /**
     * @return int|null
     */
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
