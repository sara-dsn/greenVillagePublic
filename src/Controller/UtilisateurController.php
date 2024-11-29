<?php

namespace App\Controller;

use App\Form\ConnexionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(): Response
    {

        return $this->render('utilisateur/inscription.html.twig', [
        ]);
    }
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(FormInterface $form): Response
    {
        $form= $form(ConnexionType::class);
        return $this->render('utilisateur/connexion.html.twig', [
        ]);
    }
}
