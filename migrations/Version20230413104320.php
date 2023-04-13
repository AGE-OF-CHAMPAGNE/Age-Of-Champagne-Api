<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413104320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE district (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, size DOUBLE PRECISION DEFAULT NULL, color_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vintage_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vintage ADD district_id INT NOT NULL, ADD vintage_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vintage ADD CONSTRAINT FK_A10153BAB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('ALTER TABLE vintage ADD CONSTRAINT FK_A10153BA62143128 FOREIGN KEY (vintage_type_id) REFERENCES vintage_type (id)');
        $this->addSql('CREATE INDEX IDX_A10153BAB08FA272 ON vintage (district_id)');
        $this->addSql('CREATE INDEX IDX_A10153BA62143128 ON vintage (vintage_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vintage DROP FOREIGN KEY FK_A10153BAB08FA272');
        $this->addSql('ALTER TABLE vintage DROP FOREIGN KEY FK_A10153BA62143128');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE vintage_type');
        $this->addSql('DROP INDEX IDX_A10153BAB08FA272 ON vintage');
        $this->addSql('DROP INDEX IDX_A10153BA62143128 ON vintage');
        $this->addSql('ALTER TABLE vintage DROP district_id, DROP vintage_type_id');
    }
}
