<?php

namespace App\Entity;

use App\Repository\DetailLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailLivraisonRepository::class)]
class DetailLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?instrument $instrument = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?livraison $livraison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

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

    public function getLivraison(): ?livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }
}
