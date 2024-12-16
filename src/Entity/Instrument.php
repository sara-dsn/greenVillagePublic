<?php

namespace App\Entity;

use App\Entity\Couleur;
use App\Entity\Rubrique;
use App\Entity\Fournisseur;
use App\Entity\TVA;
use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column]
    private ?float $prix_ht = null;

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

    #[ORM\OneToOne(mappedBy: 'instrument', cascade: ['persist', 'remove'])]
    private ?Photo $photo = null;

    /**
     * @var Collection<int, Description>
     */
    #[ORM\OneToMany(targetEntity: Description::class, mappedBy: 'instrument')]
    private Collection $descriptions;

    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
    }

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

    public function getPrixHt(): ?float
    {
        return $this->prix_ht;
    }

    public function setPrixHt(float $prix_ht): static
    {
        $this->prix_ht = $prix_ht;

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

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): static
    {
        // unset the owning side of the relation if necessary
        if ($photo === null && $this->photo !== null) {
            $this->photo->setInstrument(null);
        }

        // set the owning side of the relation if necessary
        if ($photo !== null && $photo->getInstrument() !== $this) {
            $photo->setInstrument($this);
        }

        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Description>
     */
    public function getDescriptions(): Collection
    {
        return $this->descriptions;
    }

    public function addDescription(Description $description): static
    {
        if (!$this->descriptions->contains($description)) {
            $this->descriptions->add($description);
            $description->setInstrument($this);
        }

        return $this;
    }

    public function removeDescription(Description $description): static
    {
        if ($this->descriptions->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getInstrument() === $this) {
                $description->setInstrument(null);
            }
        }

        return $this;
    }


}
