<?php

namespace App\Controller;

use DateTime;
use App\Entity\Client;
use App\Entity\Adresse;
use App\Form\ConnexionType;
use App\Form\InscriptionType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\Clock\now;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function inscription(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $formI=$this->createForm(InscriptionType::class);  
        

        if($formI->isSubmitted() && $formI->isValid()){
            $formI->handleRequest($request);
            $data=$formI->getData();
            $leMail=$data['mail'];
            $presence=$entityManager->getRepository(Client::class)->findBy['mail'];


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
            
            $mail = (new TemplatedEmail())
            ->from('greenVillage@example.com')
            ->to(new Address($data['mail']))
            ->subject('Confirmer votre compte GreenVillage')

            // path of the Twig template to render
            ->htmlTemplate('mail/mail.html.twig')

            // change locale used in the template, e.g. to match user's locale
            ->locale('de')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => $data['mail'],
                'name'=>$data['prenom'],

            ])
        ;
        $mailer->send($mail);
            // $mail=(new Email())
            // ->from('GreenVillage@gmail.com')
            // ->to($data['mail'])
            // //->cc('cc@example.com')
            // //->bcc('bcc@example.com')
            // //->replyTo('fabien@example.com')
            // //->priority(Email::PRIORITY_HIGH)
            // ->subject('Confirmation de votre compte Green Village')
            // ->text("Veuillez confirmer votre compte en cliquant sur le lien ci-dessous s'il vous plaît")
            // // ->html('<p>See Twig integration for better HTML integration!</p>');
            // ;
            // $mailer->send($mail);

            return $this->redirectToRoute('utilisateur/test.html.twig',[
                
            ]);
        }
        return $this->render('utilisateur/inscription.html.twig', [
            'formI'=>$formI,
        ]);
    }
}
