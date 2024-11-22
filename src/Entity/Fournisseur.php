<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $SIREN = null;

    #[ORM\Column]
    private ?bool $importateur = null;

    #[ORM\Column]
    private ?bool $constructeur = null;

    #[ORM\Column]
    private ?int $numero_telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_fournisseur = null;

    /**
     * @var Collection<int, Instrument>
     */
    #[ORM\OneToMany(targetEntity: Instrument::class, mappedBy: 'reference_fournisseur')]
    private Collection $instruments;

    #[ORM\OneToOne(mappedBy: 'fournisseur', cascade: ['persist', 'remove'])]
    private ?Adresse $adresse = null;





    public function __construct()
    {
        $this->instruments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSIREN(): ?string
    {
        return $this->SIREN;
    }

    public function setSIREN(string $SIREN): static
    {
        $this->SIREN = $SIREN;

        return $this;
    }

    public function isImportateur(): ?bool
    {
        return $this->importateur;
    }

    public function setImportateur(bool $importateur): static
    {
        $this->importateur = $importateur;

        return $this;
    }

    public function isConstructeur(): ?bool
    {
        return $this->constructeur;
    }

    public function setConstructeur(bool $constructeur): static
    {
        $this->constructeur = $constructeur;

        return $this;
    }

    public function getNumeroTelephone(): ?int
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(int $numero_telephone): static
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nom_fournisseur;
    }

    public function setNomFournisseur(string $nom_fournisseur): static
    {
        $this->nom_fournisseur = $nom_fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstruments(): Collection
    {
        return $this->instruments;
    }

    public function addInstrument(Instrument $instrument): static
    {
        if (!$this->instruments->contains($instrument)) {
            $this->instruments->add($instrument);
            $instrument->setReferenceFournisseur($this);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): static
    {
        if ($this->instruments->removeElement($instrument)) {
            // set the owning side to null (unless already changed)
            if ($instrument->getReferenceFournisseur() === $this) {
                $instrument->setReferenceFournisseur(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        // unset the owning side of the relation if necessary
        if ($adresse === null && $this->adresse !== null) {
            $this->adresse->setFournisseur(null);
        }

        // set the owning side of the relation if necessary
        if ($adresse !== null && $adresse->getFournisseur() !== $this) {
            $adresse->setFournisseur($this);
        }

        $this->adresse = $adresse;

        return $this;
    }




}
