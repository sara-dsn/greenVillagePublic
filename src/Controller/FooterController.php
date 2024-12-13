<?php

namespace App\Controller;


use App\Entity\Rubrique;
use App\Entity\Instrument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends AbstractController
{
 
    #[Route('/accessibilite', name: 'app_accessibilite')]
    public function accessibilite(): Response
    {
        return $this->render('footer/accessibilite.html.twig', []);
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('footer/cgu.html.twig', []);
    }

    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('footer/cgv.html.twig', []);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('footer/contact.html.twig', []);
    }

    #[Route('/mentionsLegales', name: 'app_mentionsLegales')]
    public function mentionsLegales(): Response
    {
        return $this->render('footer/mentionsLegales.html.twig', []);
    }

    #[Route('/planSite', name: 'app_planSite')]
    public function planSite(): Response
    {
        return $this->render('footer/planSite.html.twig', []);
    }

    #[Route('/politiqueDeConfidentialite', name: 'app_politiqueDeConfidentialite')]
    public function politiqueDeConfidentialite(): Response
    {
        return $this->render('footer/politiqueDeConfidentialite.html.twig', []);
    }
    
    
 

   
}
