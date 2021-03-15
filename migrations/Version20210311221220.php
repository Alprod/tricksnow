<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311221220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Table image et vidéo';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, figures_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C53D045F5C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, figures_id INT DEFAULT NULL, title VARCHAR(90) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, INDEX IDX_7CC7DA2C5C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE video');
    }
}
