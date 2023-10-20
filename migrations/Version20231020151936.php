<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020151936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, num_telephone INT NOT NULL, actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_268B9C9DF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blessure (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, graviter VARCHAR(255) NOT NULL, soins VARCHAR(255) NOT NULL, date DATE NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_56D071A243787BBA (citoyen_id), INDEX IDX_56D071A23414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certificats (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, observations VARCHAR(255) NOT NULL, note VARCHAR(255) DEFAULT NULL, date DATE NOT NULL, temps INT NOT NULL, INDEX IDX_D5486F1B43787BBA (citoyen_id), INDEX IDX_D5486F1B3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citoyen (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, username VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, num_telephone INT NOT NULL, sexe VARCHAR(255) NOT NULL, taille INT NOT NULL, metier VARCHAR(255) NOT NULL, groupe_sanguin VARCHAR(10) NOT NULL, poids INT NOT NULL, numero_urgence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE examen (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, observations VARCHAR(255) NOT NULL, recommendation VARCHAR(255) NOT NULL, temps INT NOT NULL, date DATE NOT NULL, INDEX IDX_514C8FEC43787BBA (citoyen_id), INDEX IDX_514C8FEC3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, temps INT NOT NULL, INDEX IDX_1981A66D43787BBA (citoyen_id), INDEX IDX_1981A66D3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, medicament VARCHAR(255) NOT NULL, date DATE NOT NULL, temps INT NOT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_924B326C43787BBA (citoyen_id), INDEX IDX_924B326C3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, raison VARCHAR(255) NOT NULL, date DATE NOT NULL, temps INT NOT NULL, lieu VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_10C31F8643787BBA (citoyen_id), INDEX IDX_10C31F863414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE therapie (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, rapport VARCHAR(255) NOT NULL, date DATE NOT NULL, temps INT NOT NULL, INDEX IDX_70C6D2C843787BBA (citoyen_id), INDEX IDX_70C6D2C83414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, motif VARCHAR(255) NOT NULL, date DATE NOT NULL, montant INT NOT NULL, payer TINYINT(1) NOT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_888A2A4C43787BBA (citoyen_id), INDEX IDX_888A2A4C3414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blessure ADD CONSTRAINT FK_56D071A243787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE blessure ADD CONSTRAINT FK_56D071A23414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE certificats ADD CONSTRAINT FK_D5486F1B43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE certificats ADD CONSTRAINT FK_D5486F1B3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8643787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F863414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE therapie ADD CONSTRAINT FK_70C6D2C843787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE therapie ADD CONSTRAINT FK_70C6D2C83414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C43787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blessure DROP FOREIGN KEY FK_56D071A243787BBA');
        $this->addSql('ALTER TABLE blessure DROP FOREIGN KEY FK_56D071A23414710B');
        $this->addSql('ALTER TABLE certificats DROP FOREIGN KEY FK_D5486F1B43787BBA');
        $this->addSql('ALTER TABLE certificats DROP FOREIGN KEY FK_D5486F1B3414710B');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC43787BBA');
        $this->addSql('ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC3414710B');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D43787BBA');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D3414710B');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C43787BBA');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C3414710B');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F8643787BBA');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F863414710B');
        $this->addSql('ALTER TABLE therapie DROP FOREIGN KEY FK_70C6D2C843787BBA');
        $this->addSql('ALTER TABLE therapie DROP FOREIGN KEY FK_70C6D2C83414710B');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C43787BBA');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C3414710B');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE blessure');
        $this->addSql('DROP TABLE certificats');
        $this->addSql('DROP TABLE citoyen');
        $this->addSql('DROP TABLE examen');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE ordonnance');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE therapie');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
