<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sans_fond = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avec_fond = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    private ?instrument $instrument = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSansFond(): ?string
    {
        return $this->sans_fond;
    }

    public function setSansFond(?string $sans_fond): static
    {
        $this->sans_fond = $sans_fond;

        return $this;
    }

    public function getAvecFond(): ?string
    {
        return $this->avec_fond;
    }

    public function setAvecFond(?string $avec_fond): static
    {
        $this->avec_fond = $avec_fond;

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
