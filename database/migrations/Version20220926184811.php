<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220926184811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option_register (id UUID NOT NULL, content VARCHAR(255) NOT NULL, question_id UUID DEFAULT NULL, correct BOOLEAN NOT NULL, picked BOOLEAN NOT NULL, PRIMARY KEY(id, content))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7F8E31B0BF396750 ON option_register (id)');
        $this->addSql('CREATE INDEX IDX_7F8E31B01E27F6BF ON option_register (question_id)');
        $this->addSql('COMMENT ON COLUMN option_register.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN option_register.question_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE option_register ADD CONSTRAINT FK_7F8E31B01E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE option_register');
    }
}
