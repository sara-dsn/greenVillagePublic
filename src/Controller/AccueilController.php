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
    #[Route('/rubrique/{id}', name: 'app_rubrique')]
    public function Rubrique(EntityManagerInterface $entityManager, int $id): Response
    {
        $test=$entityManager->getRepository(Rubrique::class)->findBy(['parent'=> NULL]);
        $rubrique=$entityManager->getRepository(Rubrique::class)->findBy(['id'=> $id]);
        $sousRubriques=$entityManager->getRepository(Rubrique::class)->findBy(['parent'=> $id]);
        return $this->render('catalogue/rubrique.html.twig', [
           'rubrique' =>$rubrique,
           'sousRubriques'=>$sousRubriques,
        //    'tests'=>$test
        ]);
    }
}
