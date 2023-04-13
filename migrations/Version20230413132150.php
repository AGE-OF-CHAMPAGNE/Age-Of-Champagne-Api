<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413132150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefit (id INT AUTO_INCREMENT NOT NULL, vintages_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, INDEX IDX_5C8B001F65315064 (vintages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE benefit ADD CONSTRAINT FK_5C8B001F65315064 FOREIGN KEY (vintages_id) REFERENCES vintage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benefit DROP FOREIGN KEY FK_5C8B001F65315064');
        $this->addSql('DROP TABLE benefit');
    }
}
