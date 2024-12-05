<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['mail'])]
#[UniqueEntity(fields: ['mail'], message: 'Il y a déjà un compte avec cet email.')]
class Client  implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column]
    private ?int $numero_telephone = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mot_de_passe_temporaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $derniere_connexion = null;

    #[ORM\Column(nullable: true)]
    private ?int $coeff_vente = null;

    #[ORM\Column(length: 255)]
    private ?string $reference_client = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_acomptes = null;

    #[ORM\OneToOne(mappedBy: 'personne', cascade: ['persist', 'remove'])]
    private ?Adresse $adresse = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(length: 255)]
    private array $roles = [];

    #[ORM\Column]
    private bool $verifie = false;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255)]
    private ?string $password = null;

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


    public function getMotDePasseTemporaire(): ?string
    {
        return $this->mot_de_passe_temporaire;
    }

    public function setMotDePasseTemporaire(?string $mot_de_passe_temporaire): static
    {
        $this->mot_de_passe_temporaire = $mot_de_passe_temporaire;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        // unset the owning side of the relation if necessary
        if ($adresse === null && $this->adresse !== null) {
            $this->adresse->setPersonne(null);
        }

        // set the owning side of the relation if necessary
        if ($adresse !== null && $adresse->getPersonne() !== $this) {
            $adresse->setPersonne($this);
        }

        $this->adresse = $adresse;

        return $this;
    }

     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->mail;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->verifie;
    }

    public function setVerified(bool $verifie): static
    {
        $this->verifie = $verifie;

        return $this;
    }
    


}
