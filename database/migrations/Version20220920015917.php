<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920015917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_b6f7494ebf396750');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE question ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX uniq_fbce3e7abf396750');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE subject ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX question_pkey');
        $this->addSql('CREATE UNIQUE INDEX uniq_b6f7494ebf396750 ON question (id)');
        $this->addSql('ALTER TABLE question ADD PRIMARY KEY (id, content)');
        $this->addSql('DROP INDEX subject_pkey');
        $this->addSql('CREATE UNIQUE INDEX uniq_fbce3e7abf396750 ON subject (id)');
        $this->addSql('ALTER TABLE subject ADD PRIMARY KEY (id, name)');
    }
}
