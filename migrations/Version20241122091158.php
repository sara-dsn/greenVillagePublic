<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122091158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816BA091CE5');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F08165A6AC879');
        $this->addSql('DROP INDEX UNIQ_C35F0816BA091CE5 ON adresse');
        $this->addSql('DROP INDEX UNIQ_C35F08165A6AC879 ON adresse');
        $this->addSql('ALTER TABLE adresse ADD personne_id INT DEFAULT NULL, ADD fournisseur_id INT DEFAULT NULL, DROP id_personne_id, DROP id_fournisseur_id');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A21BD112 FOREIGN KEY (personne_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F0816A21BD112 ON adresse (personne_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F0816670C757F ON adresse (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A21BD112');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816670C757F');
        $this->addSql('DROP INDEX UNIQ_C35F0816A21BD112 ON adresse');
        $this->addSql('DROP INDEX UNIQ_C35F0816670C757F ON adresse');
        $this->addSql('ALTER TABLE adresse ADD id_personne_id INT DEFAULT NULL, ADD id_fournisseur_id INT DEFAULT NULL, DROP personne_id, DROP fournisseur_id');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F08165A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F0816BA091CE5 ON adresse (id_personne_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C35F08165A6AC879 ON adresse (id_fournisseur_id)');
    }
}
