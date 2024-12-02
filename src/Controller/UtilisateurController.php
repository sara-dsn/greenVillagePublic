<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Adresse;
use App\Form\ConnexionType;
use App\Form\InscriptionType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function Symfony\Component\Clock\now;

class UtilisateurController extends AbstractController
{
 
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        $client= new Client();
        $formC=$this->createForm(ConnexionType::class, $client);

        return $this->render('utilisateur/connexion.html.twig', [
            'formC'=>$formC
        ]);
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, EntityManagerInterface $manager): Response
    {
        $formI=$this->createForm(InscriptionType::class);

        $formI->handleRequest($request);
        if($formI->isSubmitted() && $formI->isValid()){

            $data=$formI->getData();

            $client= new Client();
            $adresse= new Adresse();
            $date= new DateTime('now');
            $mdp=password_hash($data['mdp'],PASSWORD_DEFAULT);
            $referenceClient=substr($data['prenom'],0,2).substr($data['nom'],0,2).random_int(0,10000);

            $client->setNom($data['nom']);
            $client->setPrenom($data['prenom']);
            $client->setMail($data['mail']);
            $client->setNumeroTelephone($data['numeroTelephone']);
            $client->setMotDePasse($mdp);
            $client->setNom($data['nom']);
            $client->setDerniereConnexion($date);
            $client->setReferenceClient($referenceClient);

            $adresse->setPersonne($client);
            $adresse->setFacturation(0);
            $adresse->setLivraison(0);
            $adresse->setActif(1);
            $adresse->setAdresse($data['adresse']);

            $adresse->setAdresse($data['adresse']);
            $adresse->setVille($data['ville']);
            $adresse->setCp($data['cp']);

            $manager->persist($client);
            $manager->persist($adresse);
            $manager->flush();

            return $this->render('utilisateur/test.html.twig',[
                
            ]);
        }
        return $this->render('utilisateur/inscription.html.twig', [
            'formI'=>$formI,
        ]);
    }
}
