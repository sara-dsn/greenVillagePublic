<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jour_livrable = null;

    #[ORM\Column]
    private ?bool $facturation = null;

    #[ORM\Column]
    private ?bool $livraison = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\OneToOne(inversedBy: 'adresse', cascade: ['persist', 'remove'])]
    private ?client $personne = null;

    #[ORM\OneToOne(inversedBy: 'adresse', cascade: ['persist', 'remove'])]
    private ?fournisseur $fournisseur = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getJourLivrable(): ?string
    {
        return $this->jour_livrable;
    }

    public function setJourLivrable(?string $jour_livrable): static
    {
        $this->jour_livrable = $jour_livrable;

        return $this;
    }

    public function isFacturation(): ?bool
    {
        return $this->facturation;
    }

    public function setFacturation(bool $facturation): static
    {
        $this->facturation = $facturation;

        return $this;
    }

    public function isLivraison(): ?bool
    {
        return $this->livraison;
    }

    public function setLivraison(bool $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getPersonne(): ?client
    {
        return $this->personne;
    }

    public function setPersonne(?client $personne): static
    {
        $this->personne = $personne;

        return $this;
    }

    public function getFournisseur(): ?fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }


}
