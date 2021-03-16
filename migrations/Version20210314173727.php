<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210314173727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Suppression group figure';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AC5734D54');
        $this->addSql('DROP TABLE group_figure');
        $this->addSql('DROP INDEX IDX_2F57B37AC5734D54 ON figure');
        $this->addSql('ALTER TABLE figure DROP group_figure_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_figure (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(90) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE figure ADD group_figure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AC5734D54 FOREIGN KEY (group_figure_id) REFERENCES group_figure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2F57B37AC5734D54 ON figure (group_figure_id)');
    }
}
