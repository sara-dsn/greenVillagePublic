<?php

namespace App\Entity;

use App\Entity\Instrument;
use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionRepository::class)]
class Description
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $info = null;

    #[ORM\ManyToOne(inversedBy: 'descriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?instrument $instrument = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function getInstrument(): ?instrument
    {
        return $this->instrument;
    }

    public function setInstrument(?instrument $instrument): static
    {
        $this->instrument = $instrument;

        return $this;
    }
}
