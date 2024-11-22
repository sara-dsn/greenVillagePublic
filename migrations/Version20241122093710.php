<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122093710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097C3BD38833');
        $this->addSql('DROP INDEX IDX_8FA4097C3BD38833 ON rubrique');
        $this->addSql('ALTER TABLE rubrique CHANGE rubrique_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097C727ACA70 FOREIGN KEY (parent_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX IDX_8FA4097C727ACA70 ON rubrique (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rubrique DROP FOREIGN KEY FK_8FA4097C727ACA70');
        $this->addSql('DROP INDEX IDX_8FA4097C727ACA70 ON rubrique');
        $this->addSql('ALTER TABLE rubrique CHANGE parent_id rubrique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rubrique ADD CONSTRAINT FK_8FA4097C3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id)');
        $this->addSql('CREATE INDEX IDX_8FA4097C3BD38833 ON rubrique (rubrique_id)');
    }
}
