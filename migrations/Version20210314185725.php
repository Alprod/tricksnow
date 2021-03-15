<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210314185725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, figures_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_C0B9F90F5C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, figure_group_id INT DEFAULT NULL, title VARCHAR(100) DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_2F57B37AF675F31B (author_id), INDEX IDX_2F57B37AFDE864F2 (figure_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_group (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, figures_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C53D045F5C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_msg_id INT DEFAULT NULL, discussion_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307F61E8C28D (author_msg_id), INDEX IDX_B6BD307F1ADED311 (discussion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, figures_id INT DEFAULT NULL, title VARCHAR(90) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_7CC7DA2C5C7F3A37 (figures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AFDE864F2 FOREIGN KEY (figure_group_id) REFERENCES figure_group (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F61E8C28D FOREIGN KEY (author_msg_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F1ADED311');
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F5C7F3A37');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F5C7F3A37');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C5C7F3A37');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AFDE864F2');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AF675F31B');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F61E8C28D');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE figure');
        $this->addSql('DROP TABLE figure_group');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
