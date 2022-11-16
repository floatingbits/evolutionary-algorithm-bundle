<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


class ProblemInstance
{
    private ?int $id = null;

    private ?Problem $problem = null;

    private ?string $serializedInstance = null;


    public function getId(): ?int
    {
        return $this->id;
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




}
