<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Floatingbits\EvolutionaryAlgorithmBundle\Problem\PersistableProblemInterface;

class ProblemInstance
{
    private ?int $id = null;

    private ?string $name = null;

    private ?Problem $problem = null;

    private ?string $serializedInstance = null;

    private ?Collection $tournamentRuns;

    private ?PersistableProblemInterface $persistableProblem = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return PersistableProblemInterface|null
     */
    public function getPersistableProblem(): ?PersistableProblemInterface
    {

        if ($this->getSerializedInstance()) {
            try {
                $deserialized = unserialize($this->getSerializedInstance());
                if ($deserialized instanceof PersistableProblemInterface) {
                    $this->persistableProblem = $deserialized;
                }

            }
            catch (\Exception $e) {
                //Maybe some stale values in the database?

            }


        }
        return $this->persistableProblem;
    }

    /**
     * @param PersistableProblemInterface|null $persistableProblem
     */
    public function setPersistableProblem(?PersistableProblemInterface $persistableProblem): void
    {
        $this->persistableProblem = $persistableProblem;
        $this->setSerializedInstance(serialize($persistableProblem));
    }

    /**
     * @return Collection|TournamentRun[]
     */
    public function getTournamentRuns(): Collection
    {
        return $this->tournamentRuns;
    }

    public function addTournamentRun(TournamentRun $occupancy): self
    {
        if (!$this->tournamentRuns->contains($occupancy)) {
            $this->tournamentRuns[] = $occupancy;
        }

        return $this;
    }

    public function removeTournamentRun(TournamentRun $occupancy): self
    {
        if ($this->tournamentRuns->contains($occupancy)) {
            $this->tournamentRuns->removeElement($occupancy);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Problem|null
     */
    public function getProblem(): ?Problem
    {
        return $this->problem;
    }

    /**
     * @param Problem|null $problem
     */
    public function setProblem(?Problem $problem): void
    {
        $this->problem = $problem;
    }

    /**
     * @return string|null
     */
    public function getSerializedInstance(): ?string
    {
        return $this->serializedInstance;
    }

    /**
     * @param string|null $serializedInstance
     */
    public function setSerializedInstance(?string $serializedInstance): void
    {
        $this->serializedInstance = $serializedInstance;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function isEditable(): bool
    {
        return count($this->tournamentRuns) === 0;
    }


}
