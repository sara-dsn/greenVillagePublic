<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122090924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD id_personne_id INT DEFAULT NULL, ADD id_fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08165A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F0816BA091CE5 ON adresse (id_personne_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F08165A6AC879 ON adresse (id_fournisseur_id)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404554DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_C74404554DE7DC5C ON client');
        $this->addSql('ALTER TABLE client DROP adresse_id');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA324DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_369ECA324DE7DC5C ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur DROP adresse_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816BA091CE5');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08165A6AC879');
        $this->addSql('DROP INDEX UNIQ_C35F0816BA091CE5 ON adresse');
        $this->addSql('DROP INDEX UNIQ_C35F08165A6AC879 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP id_personne_id, DROP id_fournisseur_id');
        $this->addSql('ALTER TABLE fournisseur ADD adresse_id INT NOT NULL');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA324DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_369ECA324DE7DC5C ON fournisseur (adresse_id)');
        $this->addSql('ALTER TABLE client ADD adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404554DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404554DE7DC5C ON client (adresse_id)');
    }
}
