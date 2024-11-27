<?php

namespace App\Controller;


use App\Entity\Rubrique;
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
        $rubriques=$entityManager->getRepository(Rubrique::class)->findAll();
        $instruments=$entityManager->getRepository(Instrument::class)->findBy([],null,3);
        return $this->render('catalogue/accueil.html.twig', [
           'instruments' =>$instruments,
           'rubriques'=>$rubriques
        ]);
    }
    #[Route('/rubrique', name: 'app_rubrique')]
    public function Rubrique(EntityManagerInterface $entityManager): Response
    {
     
        $rubriques=$entityManager->getRepository(Rubrique::class)->findAll();
        return $this->render('catalogue/rubrique.html.twig', [
           'rubriques' =>$rubriques,
        ]);
    }
}
