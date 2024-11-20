<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\Column]
    private ?float $total_hors_taxe = null;

    #[ORM\Column]
    private ?bool $paye = null;

    #[ORM\Column(nullable: true)]
    private ?int $reduction = null;

    #[ORM\Column(length: 255)]
    private ?string $delais_reglement = null;

    #[ORM\Column(length: 255)]
    private ?string $moyen_paiment = null;

    #[ORM\Column]
    private ?float $frais_port = null;

    #[ORM\Column]
    private ?bool $paiment_differe = null;

    #[ORM\Column(nullable: true)]
    private ?float $acompte = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTimeInterface $date_edition = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_paiment = null;

    #[ORM\Column]
    private ?bool $prete = null;

    /**
     * @var Collection<int, livraison>
     */
    #[ORM\OneToMany(targetEntity: livraison::class, mappedBy: 'commande')]
    private Collection $livraison;

    /**
     * @var Collection<int, Detail>
     */
    #[ORM\OneToMany(targetEntity: DetailCommande::class, mappedBy: 'commande', orphanRemoval: true)]
    private Collection $detailCommandes;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
        $this->detailCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getTotalHorsTaxe(): ?float
    {
        return $this->total_hors_taxe;
    }

    public function setTotalHorsTaxe(float $total_hors_taxe): static
    {
        $this->total_hors_taxe = $total_hors_taxe;

        return $this;
    }

    public function isPaye(): ?bool
    {
        return $this->paye;
    }

    public function setPaye(bool $paye): static
    {
        $this->paye = $paye;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(?int $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getDelaisReglement(): ?string
    {
        return $this->delais_reglement;
    }

    public function setDelaisReglement(string $delais_reglement): static
    {
        $this->delais_reglement = $delais_reglement;

        return $this;
    }

    public function getMoyenPaiment(): ?string
    {
        return $this->moyen_paiment;
    }

    public function setMoyenPaiment(string $moyen_paiment): static
    {
        $this->moyen_paiment = $moyen_paiment;

        return $this;
    }

    public function getFraisPort(): ?float
    {
        return $this->frais_port;
    }

    public function setFraisPort(float $frais_port): static
    {
        $this->frais_port = $frais_port;

        return $this;
    }

    public function isPaimentDiffere(): ?bool
    {
        return $this->paiment_differe;
    }

    public function setPaimentDiffere(bool $paiment_differe): static
    {
        $this->paiment_differe = $paiment_differe;

        return $this;
    }

    public function getAcompte(): ?float
    {
        return $this->acompte;
    }

    public function setAcompte(?float $acompte): static
    {
        $this->acompte = $acompte;

        return $this;
    }

    public function getDateEdition(): ?\DateTimeInterface
    {
        return $this->date_edition;
    }

    public function setDateEdition(\DateTimeInterface $date_edition): static
    {
        $this->date_edition = $date_edition;

        return $this;
    }

    public function getDatePaiment(): ?\DateTimeInterface
    {
        return $this->date_paiment;
    }

    public function setDatePaiment(?\DateTimeInterface $date_paiment): static
    {
        $this->date_paiment = $date_paiment;

        return $this;
    }

    public function isPrete(): ?bool
    {
        return $this->prete;
    }

    public function setPrete(bool $prete): static
    {
        $this->prete = $prete;

        return $this;
    }

    /**
     * @return Collection<int, livraison>
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(livraison $livraison): static
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison->add($livraison);
            $livraison->setCommande($this);
        }

        return $this;
    }

    public function removeLivraison(livraison $livraison): static
    {
        if ($this->livraison->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getCommande() === $this) {
                $livraison->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Detail>
     */
    public function getDetails(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetail(DetailCommande $detail): static
    {
        if (!$this->detailCommandes->contains($detail)) {
            $this->detailCommandes->add($detail);
            $detail->setCommande($this);
        }

        return $this;
    }

    public function removeDetail(DetailCommande $detail): static
    {
        if ($this->detailCommandes->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCommande() === $this) {
                $detail->setCommande(null);
            }
        }

        return $this;
    }
}
