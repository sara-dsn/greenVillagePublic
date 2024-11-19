<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119142911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, cp INT NOT NULL, ville VARCHAR(255) NOT NULL, jour_livrable VARCHAR(255) DEFAULT NULL, facturation TINYINT(1) NOT NULL, livraison TINYINT(1) NOT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, siret VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, numero_telephone SMALLINT NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, mot_de_pass_temporaire VARCHAR(255) DEFAULT NULL, derniere_connexion DATE NOT NULL, coeff_vente INT DEFAULT NULL, reference_client VARCHAR(255) NOT NULL, total_acomptes DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_adresse (client_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_91624C6B19EB6921 (client_id), INDEX IDX_91624C6B4DE7DC5C (adresse_id), PRIMARY KEY(client_id, adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, total DOUBLE PRECISION NOT NULL, total_hors_taxe DOUBLE PRECISION NOT NULL, paye TINYINT(1) NOT NULL, reduction INT DEFAULT NULL, delais_reglement VARCHAR(255) NOT NULL, moyen_paiment VARCHAR(255) NOT NULL, frais_port DOUBLE PRECISION NOT NULL, paiment_differe TINYINT(1) NOT NULL, acompte DOUBLE PRECISION DEFAULT NULL, date_edition DATETIME NOT NULL, date_paiment DATETIME DEFAULT NULL, prete TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercial (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, numero_telephone SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, nom_couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail (id INT AUTO_INCREMENT NOT NULL, instrument_id INT NOT NULL, commande_id INT NOT NULL, quantite INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2E067F93CF11D9C (instrument_id), INDEX IDX_2E067F9382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, pdf VARCHAR(255) DEFAULT NULL, date_facture DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, siren VARCHAR(255) NOT NULL, importateur TINYINT(1) NOT NULL, constructeur TINYINT(1) NOT NULL, numero_telephone SMALLINT NOT NULL, mail VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_369ECA324DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, couleur_id INT NOT NULL, tva_id INT NOT NULL, reference_fournisseur_id INT NOT NULL, rubrique_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, stock_unite INT NOT NULL, photo VARCHAR(255) NOT NULL, prix_hors_taxe DOUBLE PRECISION NOT NULL, INDEX IDX_3CBF69DDC31BA576 (couleur_id), INDEX IDX_3CBF69DD4D79775F (tva_id), INDEX IDX_3CBF69DD3E9CB05D (reference_fournisseur_id), INDEX IDX_3CBF69DD3BD38833 (rubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, date_livraison DATETIME DEFAULT NULL, livre TINYINT(1) NOT NULL, INDEX IDX_A60C9F1F82EA2E54 (commande_id), INDEX IDX_A60C9F1F7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, rubrique_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_8FA4097C3BD38833 (rubrique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, taux_tva INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_adresse ADD CONSTRAINT FK_91624C6B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_adresse ADD CONSTRAINT FK_91624C6B4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA324DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD4D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD3E9CB05D FOREIGN KEY (reference_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097C3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_adresse DROP FOREIGN KEY FK_91624C6B19EB6921');
        $this->addSql('ALTER TABLE client_adresse DROP FOREIGN KEY FK_91624C6B4DE7DC5C');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93CF11D9C');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA324DE7DC5C');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDC31BA576');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD4D79775F');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD3E9CB05D');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD3BD38833');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F7F2DEE08');
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097C3BD38833');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_adresse');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commercial');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE detail');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE tva');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
