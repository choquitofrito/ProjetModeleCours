<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306134729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455AE7FEF94');
        $this->addSql('DROP INDEX IDX_C7440455AE7FEF94 ON client');
        $this->addSql('ALTER TABLE client DROP emprunt_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client ADD emprunt_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455AE7FEF94 FOREIGN KEY (emprunt_id) REFERENCES emprunt (id)');
        $this->addSql('CREATE INDEX IDX_C7440455AE7FEF94 ON client (emprunt_id)');
    }
}
