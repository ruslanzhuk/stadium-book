<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260811101947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE venue_rows (id UUID NOT NULL, row_label VARCHAR(25) NOT NULL, display_order INT NOT NULL, capacity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, section_id UUID NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_BCADF909D823E37A ON venue_rows (section_id)');
        $this->addSql('CREATE TABLE venue_seats (id UUID NOT NULL, seat_label VARCHAR(25) NOT NULL, seat_type VARCHAR(25) NOT NULL, x_pos DOUBLE PRECISION DEFAULT NULL, y_pos DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, rotation DOUBLE PRECISION NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, row_id UUID NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_67595A8783A269F2 ON venue_seats (row_id)');
        $this->addSql('CREATE TABLE venue_sections (id UUID NOT NULL, name VARCHAR(100) NOT NULL, display_order INT NOT NULL, capacity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, venue_id UUID NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_4A4D74BC40A73EBA ON venue_sections (venue_id)');
        $this->addSql('CREATE TABLE venues (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(3) NOT NULL, capacity INT NOT NULL, description TEXT DEFAULT NULL, image_url TEXT DEFAULT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE venue_rows ADD CONSTRAINT FK_BCADF909D823E37A FOREIGN KEY (section_id) REFERENCES venue_sections (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE venue_seats ADD CONSTRAINT FK_67595A8783A269F2 FOREIGN KEY (row_id) REFERENCES venue_rows (id) ON DELETE CASCADE NOT DEFERRABLE');
        $this->addSql('ALTER TABLE venue_sections ADD CONSTRAINT FK_4A4D74BC40A73EBA FOREIGN KEY (venue_id) REFERENCES venues (id) ON DELETE CASCADE NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE venue_rows DROP CONSTRAINT FK_BCADF909D823E37A');
        $this->addSql('ALTER TABLE venue_seats DROP CONSTRAINT FK_67595A8783A269F2');
        $this->addSql('ALTER TABLE venue_sections DROP CONSTRAINT FK_4A4D74BC40A73EBA');
        $this->addSql('DROP TABLE venue_rows');
        $this->addSql('DROP TABLE venue_seats');
        $this->addSql('DROP TABLE venue_sections');
        $this->addSql('DROP TABLE venues');
    }
}
