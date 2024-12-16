<?php

namespace App\Controller;

use App\Entity\Description;
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
        $rubriques=$entityManager->getRepository(Rubrique::class)->findBy(["parent"=>NULL]);
        $instruments=$entityManager->getRepository(Instrument::class)->findBy([],null,3);
        return $this->render('catalogue/accueil.html.twig', [
           'instruments' =>$instruments,
           'rubriques'=>$rubriques
        ]);
    }
    #[Route('/rubrique/{id}', name: 'app_rubrique')]
    public function sousRubrique(EntityManagerInterface $entityManager, int $id): Response
    {
        // $test=$entityManager->getRepository(Rubrique::class)->findBy(['parent'=> NULL]);
        $rubrique=$entityManager->getRepository(Rubrique::class)->findBy(['id'=> $id]);
        $sousRubriques=$entityManager->getRepository(Rubrique::class)->findBy(['parent'=> $id]);
        return $this->render('catalogue/sousRubrique.html.twig', [
           'rubrique' =>$rubrique,
           'sousRubriques'=>$sousRubriques,
        //    'tests'=>$test
        ]);
    }
    #[Route('instrument/{id}', name: 'app_instrument')]
    public function instrument(EntityManagerInterface $entityManager, $id): Response
    {
        $rubrique=$entityManager->getRepository(Rubrique::class)->findBy(['id'=>$id]);
        $instruments=$entityManager->getRepository(Instrument::class)->findBy(['rubrique'=> $id ]);
        return $this->render('catalogue/instrument.html.twig', [
           'instruments' =>$instruments,
           'rubrique'=>$rubrique
        ]);
    }
    #[Route('detail/{id}', name: 'app_detail')]
    public function detail(EntityManagerInterface $entityManager, $id): Response
    {
        $descriptions=$entityManager->getRepository(Description::class)->findBy(["instrument_id"=>$id]);
        $detail=$entityManager->getRepository(instrument::class)->findBy(['id'=> $id ]);
        return $this->render('catalogue/detail.html.twig', [
           'detail' =>$detail,
           'descriptions' =>$descriptions,
        ]);
    }

   
}
