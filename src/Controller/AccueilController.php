<?php

namespace App\Controller;


use App\Entity\Instrument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function accueil(EntityManagerInterface $entityManager): Response
    {
     
        $instruments=$entityManager->getRepository(Instrument::class)->findBy([],null,3);
        return $this->render('accueil/accueil.html.twig', [
           'instruments' =>$instruments,
        ]);
    }
    #[Route('/cat', name: 'app_sousRubrique')]
    public function SousRubrique(EntityManagerInterface $entityManager): Response
    {
     
        $instruments=$entityManager->getRepository(Instrument::class)->findBy([],null,3);
        return $this->render('accueil/accueil.html.twig', [
           'instruments' =>$instruments,
        ]);
    }
}
