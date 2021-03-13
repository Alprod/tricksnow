<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313143023 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F1EBAF6CC');
        $this->addSql('DROP INDEX IDX_C0B9F90F1EBAF6CC ON discussion');
        $this->addSql('ALTER TABLE discussion CHANGE articles_id figures_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F5C7F3A37 FOREIGN KEY (figures_id) REFERENCES figure (id)');
        $this->addSql('CREATE INDEX IDX_C0B9F90F5C7F3A37 ON discussion (figures_id)');
        $this->addSql('ALTER TABLE figure CHANGE update_at update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE message CHANGE contenu contenu LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE update_at update_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90F5C7F3A37');
        $this->addSql('DROP INDEX IDX_C0B9F90F5C7F3A37 ON discussion');
        $this->addSql('ALTER TABLE discussion CHANGE figures_id articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90F1EBAF6CC FOREIGN KEY (articles_id) REFERENCES figure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C0B9F90F1EBAF6CC ON discussion (articles_id)');
        $this->addSql('ALTER TABLE figure CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE contenu contenu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE update_at update_at DATETIME NOT NULL');
    }
}
