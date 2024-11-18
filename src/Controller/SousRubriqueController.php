<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SousRubriqueController extends AbstractController
{
    #[Route('/tambour', name: 'app_tambour')]
    public function tambour(): Response
    {
        return $this->render('sousRubrique/tambour.html.twig', [
            'controller_name' => 'TambourController',
        ]);
    }
    #[Route('/djembe', name: 'app_djembe')]
    public function djembe(): Response
    {
        return $this->render('sousRubrique/djembe.html.twig', [
            'controller_name' => 'DjembeController',
        ]);
    }
    #[Route('/batterie', name: 'app_batterie')]
    public function batterie(): Response
    {
        return $this->render('sousRubrique/batterie.html.twig', [
            'controller_name' => 'BatterieController',
        ]);
    }
    #[Route('/bongo', name: 'app_bongo')]
    public function bongo(): Response
    {
        return $this->render('sousRubrique/bongo.html.twig', [
            'controller_name' => 'BongoController',
        ]);
    }
    #[Route('/clarinette', name: 'app_clarinette')]
    public function clarinette(): Response
    {
        return $this->render('sousRubrique/clarinette.html.twig', [
            'controller_name' => 'ClarinetteController',
        ]);
    }
    #[Route('/saxophone', name: 'app_saxophone')]
    public function saxophone(): Response
    {
        return $this->render('sousRubrique/saxophone.html.twig', [
            'controller_name' => 'SaxophoneController',
        ]);
    }
    #[Route('/traversiere', name: 'app_traversiere')]
    public function travèrsiere(): Response
    {
        return $this->render('sousRubrique/traversiere.html.twig', [
            'controller_name' => 'TraversiereController',
        ]);
    }
    #[Route('/flute', name: 'app_flute')]
    public function flute(): Response
    {
        return $this->render('sousRubrique/flute.html.twig', [
            'controller_name' => 'FluteController',
        ]);
    }
    #[Route('/piano', name: 'app_piano')]
    public function piano(): Response
    {
        return $this->render('sousRubrique/piano.html.twig', [
            'controller_name' => 'PianoController',
        ]);
    }
    #[Route('/guitare', name: 'app_guitare')]
    public function guitare(): Response
    {
        return $this->render('sousRubrique/guitare.html.twig', [
            'controller_name' => 'GuitareController',
        ]);
    }
    #[Route('/harpe', name: 'app_harpe')]
    public function harpe(): Response
    {
        return $this->render('sousRubrique/harpe.html.twig', [
            'controller_name' => 'HarpeController',
        ]);
    }
    #[Route('/alto', name: 'app_alto')]
    public function alto(): Response
    {
        return $this->render('sousRubrique/alto.html.twig', [
            'controller_name' => 'AltoController',
        ]);
    }
    #[Route('/contrebasse', name: 'app_contrebasse')]
    public function contrebasse(): Response
    {
        return $this->render('sousRubrique/contrebasse.html.twig', [
            'controller_name' => 'ContrebasseController',
        ]);
    }
    #[Route('/violoncelle', name: 'app_violoncelle')]
    public function violoncelle(): Response
    {
        return $this->render('sousRubrique/violoncelle.html.twig', [
            'controller_name' => 'VioloncelleController',
        ]);
    }
}
