<?php

namespace App\DataFixtures;

use App\Entity\Couleur;
USE App\Entity\Tva;
USE App\Entity\Adresse;
USE App\Entity\Fournisseur;
USE App\Entity\Client;
USE App\Entity\Instrument;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $couleur = new Couleur();
        $couleur->setNomCouleur("noir");
        $manager->persist($couleur);
        $manager->flush();

        $tva = new Tva();
        $tva->setTauxTva(20);
        $manager->persist($tva);
        $manager->flush();

        $adresse = new Adresse();
        $adresse->setAdresse("2 rue du pont");
        $adresse->setCp("13012");
        $adresse->setVille("Marseille");
        $adresse->setFacturation(0);
        $adresse->setLivraison(0);
        $adresse->setActif(1);


        $manager->persist($adresse);
        $manager->flush();

        $fournisseur = new Fournisseur();
        // $fournisseur->setAdresse(1);
        $fournisseur->setSiren("123 456 789");
        $fournisseur->setNumeroTelephone(0936251694);
        $fournisseur->setMail("o_bois@gmail.com");
        $fournisseur->setSiret("123 456 789 10111");
        $fournisseur->setNomFournisseur("O'bois");
        $fournisseur->setImportateur(1);
        $fournisseur->setConstructeur(0);


        $manager->persist($fournisseur);
        $manager->flush();

        // $couleur = new Couleur();
        // $couleur->setNomCouleur("noir");
        // $manager->persist($couleur);
        // $manager->flush();

        // $couleur = new Couleur();
        // $couleur->setNomCouleur("noir");
        // $manager->persist($couleur);
        // $manager->flush();
    }
}
