<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


class TournamentConfiguration
{
    private ?int $id = null;

    private ?TournamentType $tournamentType = null;

    private ?string $serializedConfiguration = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return TournamentType|null
     */
    public function getTournamentType(): ?TournamentType
    {
        return $this->tournamentType;
    }

    /**
     * @param TournamentType|null $tournamentType
     */
    public function setTournamentType(?TournamentType $tournamentType): void
    {
        $this->tournamentType = $tournamentType;
    }

    /**
     * @return string|null
     */
    public function getSerializedConfiguration(): ?string
    {
        return $this->serializedConfiguration;
    }

    /**
     * @param string|null $serializedConfiguration
     */
    public function setSerializedConfiguration(?string $serializedConfiguration): void
    {
        $this->serializedConfiguration = $serializedConfiguration;
    }

    public function __toString(): string
    {
        return $this->getTournamentType()->getName() . '-' . $this->getId();
    }


}
