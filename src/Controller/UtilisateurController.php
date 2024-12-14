<?php

namespace App\Controller;

use DateTime;
use App\Entity\Client;
use App\Entity\Adresse;
use App\Form\ConnexionType;
use App\Form\InscriptionType;
use App\Form\MdpOublieType;
use App\Security\EmailVerifier;
use Symfony\Component\Clock\now;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class UtilisateurController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier) {

    }
    

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request , Security $security, EntityManagerInterface $entityManager, MailerInterface $mailer,): Response
    {
        $formI = $this->createForm(InscriptionType::class);
        $formI->handleRequest($request);

        if ($formI->isSubmitted() && $formI->isValid()) {
            $data = $formI->getData();
            $leMail = $data['mail'];

            $presence = $entityManager->getRepository(Client::class)->findBy(["mail" => $leMail]);

            if (empty($presence)) {
                $client = new Client();
                $adresse = new Adresse();
                $date = new DateTime('now');
                $mdp = password_hash($data['password'], PASSWORD_DEFAULT);
                $referenceClient = substr($data['prenom'], 0, 2) . substr($data['nom'], 0, 2) . random_int(0, 10000);

                $client->setNom($data['nom']);
                $client->setPrenom($data['prenom']);
                $client->setMail($data['mail']);
                $client->setNumeroTelephone($data['numeroTelephone']);
                $client->setPassword($mdp);
                $client->setNom($data['nom']);
                $client->setDerniereConnexion($date);
                $client->setReferenceClient($referenceClient);
                $client->setRoles(['ROLE_USER']);

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

                $session=$request->getSession()->set("LAST_USERNAME" , $leMail);

                $this->emailVerifier->sendEmailConfirmation(
                    'app_confirmationMail',
                    $client,
                    (new TemplatedEmail())
                        ->from('greenVillage@example.com')
                        ->to($client->getMail())
                        ->subject('Confirmer votre compte GreenVillage')

                        // path of the Twig template to render
                        ->htmlTemplate('message/mail.html.twig')

                        // change locale used in the template, e.g. to match user's locale
                        // ->locale('de')

                        // pass variables (name => value) to the template
                        ->context([
                            'expiration_date' => new \DateTime('+7 days'),
                            'username' => $data['mail'],
                            'name' => $data['prenom'],
                        ])
                    );

                return $security->login($client, 'form_login', 'main');

            } else {
                $dejaCompte = 'Vous avez déjà un compte Green Village.';
                return $this->redirectToRoute('app_connexion', [
                    'dejaCompte' => $dejaCompte,
                    'mail' => $leMail,
                ]);
            };
        }
        return $this->render('utilisateur/inscription.html.twig', [
            'formI' => $formI,
        ]);
    }
    


    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(Request $request, EntityManagerInterface $entityManager, Security $security, AuthenticationUtils $auth): Response
    {
        $erreur = $auth->getLastAuthenticationError();
        $dernierPseudo = $auth->getLastUsername();
        $client = new Client();
        $formC = $this->createForm(ConnexionType::class, $client);
        $formC->handlerequest($request);

        if ($formC->isSubmitted() && $formC->isValid()) {
            $data = $formC->getData();
            $mail = $data['mail'];

            $utilisateur = $entityManager->getRepository(Client::class)->findBy(['mail' => $mail]);
            if ($utilisateur) {
                $mdpCorrect = $utilisateur['password'];
                $mdp = $data('password');
                if (password_verify($mdp, $mdpCorrect[0])) {
                    // $session=$request->getSession($mail);
                    // entrer dans BdD une nouvelle date de connexion


                } else {

                    return $this->redirectToRoute('app_connexion', [
                        'message' => "L'email ou le mot de passe est incorrect",
                        'erreur' => $erreur,
                        'pseudo' => $dernierPseudo,
                    ]);
                }
            } else {
                return $this->redirectToRoute('app_inscription', [
                    'message' => "Vous n'êtes pas encore inscrit",
                ]);
            };
        }

        return $this->render('utilisateur/connexion.html.twig', [
            'formC' => $formC,
            // 'message'=>'',
        ]);
    }
  


    #[Route('/confirmationMail', name: 'app_confirmationMail')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            /** @var Client $user */
            $user = $this->getUser();
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_connexion');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', "Votre adresse mail vient d'être vérifée.");

        return $this->redirectToRoute('app_activeCompte');
    }



    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // renvoie l'utilisateur actuellement connecté, ou null si personne n'est connecté.
        if ($this->getUser()) {
            // Si un utilisateur est déjà connecté, il est redirigé vers la page profil, cela l'empêche de voir la page de connexion inutilement.
            return $this->redirectToRoute('app_profil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // si l'utilisateur n'est pas connecté
        return $this->render('utilisateur/test2.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

        // si l'utilisateur est connecté grâce au formulaire de connexion
        return $this->redirectToRoute('app_profil');
    } 



    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    } 
    
     #[Route(path: '/profil', name: 'app_profil')]
    public function profil(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
       
        return $this->render('utilisateur/profil.html.twig');

    } 
    
    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('utilisateur/test.html.twig', []);
    }
    #[Route('/test2', name: 'app_test2')]
    public function test2(): Response
    {
        return $this->render('utilisateur/test2.html.twig', []);
    }
    #[Route('/activeCompte', name: 'app_activeCompte')]
    public function activeCompte(): Response
    {
        return $this->render('message/activeCompte.html.twig', []);
    }

    #[Route('/mdpOublie', name: 'app_mdpOublie')]
    public function mdpOublie(Request $request): Response
    {
        $formO=$this->createForm(MdpOublieType::class);
        return $this->render('utilisateur/mdpOublie.html.twig', [
            "fromO"=>$formO,
        ]);
    }
}
