<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106175032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE certificats (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, observations VARCHAR(255) NOT NULL, note VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, temps INT NOT NULL, INDEX IDX_D5486F1B43787BBA (citoyen_id), INDEX IDX_D5486F1B3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE certificats ADD CONSTRAINT FK_D5486F1B43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE certificats ADD CONSTRAINT FK_D5486F1B3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificats DROP FOREIGN KEY FK_D5486F1B43787BBA');
        $this->addSql('ALTER TABLE certificats DROP FOREIGN KEY FK_D5486F1B3414710B');
        $this->addSql('DROP TABLE certificats');
    }
}
