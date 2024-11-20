<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $numero_telephone = null;

    #[ORM\Column(length: 50)]
    private ?string $mot_de_passe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mot_de_pass_temporaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $derniere_connexion = null;

    #[ORM\Column(nullable: true)]
    private ?int $coeff_vente = null;

    #[ORM\Column(length: 255)]
    private ?string $reference_client = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_acomptes = null;

    /**
     * @var Collection<int, adresse>
     */
    #[ORM\ManyToMany(targetEntity: adresse::class)]
    private Collection $adresse;

    public function __construct()
    {
        $this->adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getNumeroTelephone(): ?int
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(int $numero_telephone): static
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getMotDePasseTemporaire(): ?string
    {
        return $this->mot_de_pass_temporaire;
    }

    public function setMotDePasseTemporaire(?string $mot_de_pass_temporaire): static
    {
        $this->mot_de_pass_temporaire = $mot_de_pass_temporaire;

        return $this;
    }

    public function getDerniereConnexion(): ?\DateTimeInterface
    {
        return $this->derniere_connexion;
    }

    public function setDerniereConnexion(\DateTimeInterface $derniere_connexion): static
    {
        $this->derniere_connexion = $derniere_connexion;

        return $this;
    }

    public function getCoeffVente(): ?int
    {
        return $this->coeff_vente;
    }

    public function setCoeffVente(?int $coeff_vente): static
    {
        $this->coeff_vente = $coeff_vente;

        return $this;
    }

    public function getReferenceClient(): ?string
    {
        return $this->reference_client;
    }

    public function setReferenceClient(string $reference_client): static
    {
        $this->reference_client = $reference_client;

        return $this;
    }

    public function getTotalAcomptes(): ?float
    {
        return $this->total_acomptes;
    }

    public function setTotalAcomptes(?float $total_acomptes): static
    {
        $this->total_acomptes = $total_acomptes;

        return $this;
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(adresse $adresse): static
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse->add($adresse);
        }

        return $this;
    }

    public function removeAdresse(adresse $adresse): static
    {
        $this->adresse->removeElement($adresse);

        return $this;
    }
}
