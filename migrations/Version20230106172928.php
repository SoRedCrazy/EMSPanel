<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230106172928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE therapie (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, rapport VARCHAR(255) NOT NULL, date DATE NOT NULL, temps INT NOT NULL, INDEX IDX_70C6D2C843787BBA (citoyen_id), INDEX IDX_70C6D2C83414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE therapie ADD CONSTRAINT FK_70C6D2C843787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE therapie ADD CONSTRAINT FK_70C6D2C83414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE therapie DROP FOREIGN KEY FK_70C6D2C843787BBA');
        $this->addSql('ALTER TABLE therapie DROP FOREIGN KEY FK_70C6D2C83414710B');
        $this->addSql('DROP TABLE therapie');
    }
}
