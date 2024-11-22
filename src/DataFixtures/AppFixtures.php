<?php

namespace App\DataFixtures;

use App\Entity\Couleur;
USE App\Entity\Tva;
USE App\Entity\Adresse;
USE App\Entity\Fournisseur;
USE App\Entity\Client;
USE App\Entity\Instrument;
USE App\Entity\Rubrique;


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

  

        $fournisseur = new Fournisseur();
        $fournisseur->setSiren("123 456 789");
        $fournisseur->setNumeroTelephone("0936252222");
        $fournisseur->setMail("o_bois@gmail.com");
        $fournisseur->setSiret("123 456 789 10111");
        $fournisseur->setNomFournisseur("O'bois");
        $fournisseur->setImportateur(1);
        $fournisseur->setConstructeur(0);

        $manager->persist($fournisseur);
        $manager->flush();


        $adresse = new Adresse();
        $adresse->setAdresse("2 rue du pont");
        $adresse->setCp("13012");
        $adresse->setVille("Marseille");
        $adresse->setFacturation(0);
        $adresse->setLivraison(0);
        $adresse->setActif(1);
        $adresse->setFournisseur($fournisseur);


        $manager->persist($adresse);
        $manager->flush();

     

        $rubrique = new Rubrique();
        $rubrique->setLibelle("Instrument à percussion");
        $rubrique->setPhoto("img");

        $manager->persist($rubrique);
        $manager->flush();

        $sousRubrique = new Rubrique();
        $sousRubrique->setParent($rubrique);
        $sousRubrique->setLibelle("Tambour");
        $sousRubrique->setPhoto("img");

        $manager->persist($sousRubrique);
        $manager->flush();

        $instrument = new instrument();
        $instrument->setCouleur($couleur);
        $instrument->setTva($tva);
        $instrument->setReferenceFournisseur($fournisseur);
        $instrument->setRubrique($sousRubrique);
        $instrument->setLibelle("tambour");
        $instrument->setDescription("cool");
        $instrument->setStockUnite("3");
        $instrument->setPhoto("3");
        $instrument->setPrixHorsTaxe("3");

        $manager->persist($instrument);
        $manager->flush();
    }
}
