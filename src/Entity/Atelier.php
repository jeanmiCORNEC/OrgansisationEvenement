<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtelierRepository::class)]
class Atelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fin = null;

    #[ORM\Column(nullable: true)]
    private ?int $participantMini = null;

    #[ORM\Column(nullable: true)]
    private ?int $participantMaxi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $materiel = null;

    #[ORM\Column]
    private ?bool $isMaintained = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getParticipantMini(): ?int
    {
        return $this->participantMini;
    }

    public function setParticipantMini(?int $participantMini): self
    {
        $this->participantMini = $participantMini;

        return $this;
    }

    public function getParticipantMaxi(): ?int
    {
        return $this->participantMaxi;
    }

    public function setParticipantMaxi(?int $participantMaxi): self
    {
        $this->participantMaxi = $participantMaxi;

        return $this;
    }

    public function getMateriel(): ?string
    {
        return $this->materiel;
    }

    public function setMateriel(?string $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function isIsMaintained(): ?bool
    {
        return $this->isMaintained;
    }

    public function setIsMaintained(bool $isMaintained): self
    {
        $this->isMaintained = $isMaintained;

        return $this;
    }
}
