<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_livraison = null;

    #[ORM\Column]
    private ?bool $livre = null;

    #[ORM\ManyToOne(inversedBy: 'livraison')]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    private ?facture $facture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(?\DateTimeInterface $date_livraison): static
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function isLivre(): ?bool
    {
        return $this->livre;
    }

    public function setLivre(bool $livre): static
    {
        $this->livre = $livre;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getFacture(): ?facture
    {
        return $this->facture;
    }

    public function setFacture(?facture $facture): static
    {
        $this->facture = $facture;

        return $this;
    }
}
