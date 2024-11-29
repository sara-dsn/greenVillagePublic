<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ConnexionType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(): Response
    {

        return $this->render('utilisateur/inscription.html.twig', [
        ]);
    }
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        $client= new Client();
        $formC=$this->createForm(ConnexionType::class, $client);
        
        return $this->render('utilisateur/connexion.html.twig', [
            'formC'=>$formC
        ]);
    }
}
