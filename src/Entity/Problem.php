<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;



class Problem
{
    private ?int $id = null;

    private ?string $name = null;

    private ?string $instanceClass = null;

    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInstanceClass(): ?string
    {
        return $this->instanceClass;
    }

    public function setInstanceClass(string $instanceClass): self
    {
        $this->instanceClass = $instanceClass;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
