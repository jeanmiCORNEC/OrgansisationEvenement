<?php

namespace App\Entity;

use App\Repository\AtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'atelier')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evenement $evenement = null;

    #[ORM\ManyToMany(targetEntity: Salle::class, inversedBy: 'ateliers')]
    private Collection $salle;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ateliers')]
    private Collection $user;

    public function __construct()
    {
        $this->salle = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

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

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return Collection<int, Salle>
     */
    public function getSalle(): Collection
    {
        return $this->salle;
    }

    public function addSalle(Salle $salle): self
    {
        if (!$this->salle->contains($salle)) {
            $this->salle->add($salle);
        }

        return $this;
    }

    public function removeSalle(Salle $salle): self
    {
        $this->salle->removeElement($salle);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
