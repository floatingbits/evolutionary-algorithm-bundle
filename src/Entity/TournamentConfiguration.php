<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Entity;


use Floatingbits\EvolutionaryAlgorithmBundle\Evolution\ConfigurableTournamentInterface;

class TournamentConfiguration
{
    private ?int $id = null;

    private ?TournamentType $tournamentType = null;

    private ?string $serializedConfiguration = '';

    private ?ConfigurableTournamentInterface $configurableTournament = null;

    /**
     * @return ConfigurableTournamentInterface|null
     */
    public function getConfigurableTournament(): ?ConfigurableTournamentInterface
    {
        $configurableTournament = null;
        if (!$this->configurableTournament) {
            $configurableTournament = unserialize($this->serializedConfiguration);
        }
        if ($configurableTournament instanceof ConfigurableTournamentInterface) {
            $this->configurableTournament = $configurableTournament;
        }
        return $this->configurableTournament;
    }

    /**
     * @param ConfigurableTournamentInterface|null $configurableTournament
     */
    public function setConfigurableTournament(?ConfigurableTournamentInterface $configurableTournament): void
    {
        $this->configurableTournament = $configurableTournament;
        $this->serializedConfiguration = serialize($this->configurableTournament);
    }




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
        $configurableTournament = unserialize($this->serializedConfiguration);
        if ($configurableTournament instanceof ConfigurableTournamentInterface) {
            $this->setConfigurableTournament($configurableTournament);
        }
    }

    public function __toString(): string
    {
        return $this->getTournamentType()->getName() . '-' . $this->getId();
    }


}
