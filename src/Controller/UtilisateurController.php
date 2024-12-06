<?php

namespace App\Controller;

use DateTime;
use App\Security\EmailVerifier;
use App\Entity\Client;
use App\Entity\Adresse;
use App\Form\ConnexionType;
use App\Form\InscriptionType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Clock\now;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UtilisateurController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(Request $request, EntityManagerInterface $entityManager, AuthenticationUtils $auth ): Response
    {
        $erreur=$auth->getLastAuthenticationError();
        $dernierPseudo=$auth->getLastUsername();
        $client= new Client();
        $formC=$this->createForm(ConnexionType::class, $client);
        $formC->handlerequest($request);
        if($formC->isSubmitted() && $formC->isValid()){
            $data=$formC->getData();
            $mail=$data['mail'];

            $utilisateur=$entityManager->getRepository(Client::class)->findBy(['mail'=>$mail]);
            if($utilisateur){
                $mdpCorrect=$utilisateur['password'];
                $mdp=$data('password');
                if(password_verify($mdp,$mdpCorrect[0])){
                    // $session=$request->getSession($mail);
                     // entrer dans BdD une nouvelle date de connexion

                }
                else{

                    return $this->render('utilisateur/connexion.html.twig', [
                        'formC'=>$formC,
                        'message'=>"L'email ou le mot de passe est incorrect",
                        'erreur'=>$erreur,
                        'pseudo'=>$dernierPseudo,
                    ]);
                }
            }
            else{
                return $this->redirectToRoute('app_inscription',[
                    'message'=>"Vous n'êtes pas encore inscrit",
                ]);
            };

        }
   
        return $this->render('utilisateur/connexion.html.twig', [
            'formC'=>$formC,
            // 'message'=>'',
        ]);
    }
    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('utilisateur/test.html.twig', [
        ]);
    }
    #[Route('/test2', name: 'app_test2')]
    public function test2(): Response
    {
       

        return $this->render('utilisateur/test2.html.twig', [
        ]);
    }


    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, ): Response
    {
        $formI=$this->createForm(InscriptionType::class);  
        $formI->handleRequest($request);
//       $lisa=$entityManager->getRepository(Client::class)->findBy(["mail"=>'lisa@gmail.com']);    
// dd($lisa);

        if($formI->isSubmitted() && $formI->isValid()){                 
            $data=$formI->getData();
            $leMail=$data['mail'];

            $presence=$entityManager->getRepository(Client::class)->findBy(["mail"=>$leMail]);    
      
            if(empty($presence)){ 
                $client= new Client();
                $adresse= new Adresse();
                $date= new DateTime('now');
                $mdp=password_hash($data['password'],PASSWORD_DEFAULT);
                $referenceClient=substr($data['prenom'],0,2).substr($data['nom'],0,2).random_int(0,10000);

                $client->setNom($data['nom']);
                $client->setPrenom($data['prenom']);
                $client->setMail($data['mail']);
                $client->setNumeroTelephone($data['numeroTelephone']);
                $client->setPassword($mdp);
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

                $entityManager->persist($client);
                $entityManager->persist($adresse);
                $entityManager->flush();

                // $session=$request->setSession($data['mail'],'ROLE_USER');

                $this->emailVerifier->sendEmailConfirmation('app_confirmationMail', $client,
                (new TemplatedEmail())
                ->from('greenVillage@example.com')
                ->to($client->getMail())
                ->subject('Confirmer votre compte GreenVillage')

                // path of the Twig template to render
                ->htmlTemplate('mail/mail.html.twig')

                // change locale used in the template, e.g. to match user's locale
               // ->locale('de')

                // pass variables (name => value) to the template
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'username' => $data['mail'],
                    'name'=>$data['prenom'],

                ])
                );
                //$mailer->send($mail);
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

                return $this->redirectToRoute('app_test');
            }
            else{
                $dejaCompte='Vous avez déjà un compte Green Village.';
                return $this->redirectToRoute('app_connexion',[
                    'dejaCompte'=>$dejaCompte,
                    'mail'=>$leMail,
                ]);

            };
        }
        return $this->render('utilisateur/inscription.html.twig', [
            'formI'=>$formI,
        ]);
    }
    
}
