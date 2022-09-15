<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220914224106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_register (id UUID NOT NULL, content VARCHAR(255) NOT NULL, exam_id UUID DEFAULT NULL, PRIMARY KEY(id, content))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3CF1F018BF396750 ON question_register (id)');
        $this->addSql('CREATE INDEX IDX_3CF1F018578D5E91 ON question_register (exam_id)');
        $this->addSql('COMMENT ON COLUMN question_register.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN question_register.exam_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE question_register ADD CONSTRAINT FK_3CF1F018578D5E91 FOREIGN KEY (exam_id) REFERENCES exam (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE answer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE answer (id UUID NOT NULL, question_id UUID DEFAULT NULL, exam_id UUID DEFAULT NULL, picked_option_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_dadd4a251e27f6bf ON answer (question_id)');
        $this->addSql('CREATE INDEX idx_dadd4a2547394f69 ON answer (picked_option_id)');
        $this->addSql('CREATE INDEX idx_dadd4a25578d5e91 ON answer (exam_id)');
        $this->addSql('COMMENT ON COLUMN answer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.question_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.exam_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN answer.picked_option_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT fk_dadd4a251e27f6bf FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT fk_dadd4a25578d5e91 FOREIGN KEY (exam_id) REFERENCES exam (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT fk_dadd4a2547394f69 FOREIGN KEY (picked_option_id) REFERENCES option (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE question_register');
    }
}
