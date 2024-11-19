<?php

namespace App\Entity;

use App\Repository\TVARepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TVARepository::class)]
class TVA
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $taux_TVA = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTauxTVA(): ?int
    {
        return $this->taux_TVA;
    }

    public function setTauxTVA(int $taux_TVA): static
    {
        $this->taux_TVA = $taux_TVA;

        return $this;
    }
}
