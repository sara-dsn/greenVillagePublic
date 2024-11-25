<?php

namespace App\Entity;

use App\Entity\Couleur;
use App\Entity\Rubrique;
use App\Entity\Fournisseur;
use App\Entity\TVA;
use App\Repository\InstrumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $stock_unite = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?float $prix_hors_taxe = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?couleur $couleur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?TVA $tva = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?fournisseur $reference_fournisseur = null;

    #[ORM\ManyToOne(inversedBy: 'instruments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?rubrique $rubrique = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStockUnite(): ?int
    {
        return $this->stock_unite;
    }

    public function setStockUnite(int $stock_unite): static
    {
        $this->stock_unite = $stock_unite;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrixHorsTaxe(): ?float
    {
        return $this->prix_hors_taxe;
    }

    public function setPrixHorsTaxe(float $prix_hors_taxe): static
    {
        $this->prix_hors_taxe = $prix_hors_taxe;

        return $this;
    }

    public function getCouleur(): ?couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?couleur $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTva(): ?TVA
    {
        return $this->tva;
    }

    public function setTva(?TVA $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getReferenceFournisseur(): ?fournisseur
    {
        return $this->reference_fournisseur;
    }

    public function setReferenceFournisseur(?fournisseur $reference_fournisseur): static
    {
        $this->reference_fournisseur = $reference_fournisseur;

        return $this;
    }

    public function getRubrique(): ?rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?rubrique $rubrique): static
    {
        $this->rubrique = $rubrique;

        return $this;
    }
}
