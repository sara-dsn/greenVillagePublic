<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241217085501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description DROP FOREIGN KEY FK_6DE44026727ACA70');
        $this->addSql('DROP INDEX IDX_6DE44026727ACA70 ON description');
        $this->addSql('ALTER TABLE description DROP parent_id, CHANGE instrument_id instrument_id INT NOT NULL, CHANGE libelle libelle VARCHAR(255) NOT NULL, CHANGE info info VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description ADD parent_id INT DEFAULT NULL, CHANGE instrument_id instrument_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE info info VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE description ADD CONSTRAINT FK_6DE44026727ACA70 FOREIGN KEY (parent_id) REFERENCES description (id)');
        $this->addSql('CREATE INDEX IDX_6DE44026727ACA70 ON description (parent_id)');
    }
}
