<?php

namespace App\Entity;

use App\Repository\CouleurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouleurRepository::class)]
class Couleur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_couleur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCouleur(): ?string
    {
        return $this->nom_couleur;
    }

    public function setNomCouleur(string $nom_couleur): static
    {
        $this->nom_couleur = $nom_couleur;

        return $this;
    }
}
