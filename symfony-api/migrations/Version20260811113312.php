<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260811113312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_1483a5e97adf3dfb');
        $this->addSql('ALTER TABLE users RENAME COLUMN email_email TO email');
        $this->addSql('ALTER TABLE users RENAME COLUMN password_hash_password_hash TO password_hash');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74');
        $this->addSql('ALTER TABLE users RENAME COLUMN email TO email_email');
        $this->addSql('ALTER TABLE users RENAME COLUMN password_hash TO password_hash_password_hash');
        $this->addSql('CREATE UNIQUE INDEX uniq_1483a5e97adf3dfb ON users (email_email)');
    }
}
