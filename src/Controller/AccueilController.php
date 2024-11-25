<?php

namespace App\Controller;

use App\Entity\Couleur;
use App\Entity\Fournisseur;
use App\Entity\Tva;
use App\Entity\Rubrique;
use App\Entity\Instrument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // $couleurs=$entityManager->getRepository(Couleur::class)->findAll();
        // $fournisseur=$entityManager->getRepository(Fournisseur::class);
        // $tva=$entityManager->getRepository(Tva::class);
        // $rubrique=$entityManager->getRepository(Rubrique::class);
        $instruments=$entityManager->getRepository(Instrument::class)->findAll();
        return $this->render('accueil/accueil.html.twig', [
           'instruments' =>$instruments,
        ]);
    }
}
