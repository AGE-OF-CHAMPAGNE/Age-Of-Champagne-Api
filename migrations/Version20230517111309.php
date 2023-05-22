<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517111309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manager (id INT AUTO_INCREMENT NOT NULL, recipient_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FA2425B9E92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, profile_picture LONGBLOB DEFAULT NULL, description VARCHAR(3000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vintage_recipient (vintage_id INT NOT NULL, recipient_id INT NOT NULL, INDEX IDX_DAE5E45348198056 (vintage_id), INDEX IDX_DAE5E453E92F8F78 (recipient_id), PRIMARY KEY(vintage_id, recipient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9E92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id)');
        $this->addSql('ALTER TABLE vintage_recipient ADD CONSTRAINT FK_DAE5E45348198056 FOREIGN KEY (vintage_id) REFERENCES vintage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vintage_recipient ADD CONSTRAINT FK_DAE5E453E92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benefit ADD recipient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE benefit ADD CONSTRAINT FK_5C8B001FE92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id)');
        $this->addSql('CREATE INDEX IDX_5C8B001FE92F8F78 ON benefit (recipient_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE used_benefit_date used_benefit_date LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benefit DROP FOREIGN KEY FK_5C8B001FE92F8F78');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B9E92F8F78');
        $this->addSql('ALTER TABLE vintage_recipient DROP FOREIGN KEY FK_DAE5E45348198056');
        $this->addSql('ALTER TABLE vintage_recipient DROP FOREIGN KEY FK_DAE5E453E92F8F78');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE recipient');
        $this->addSql('DROP TABLE vintage_recipient');
        $this->addSql('DROP INDEX IDX_5C8B001FE92F8F78 ON benefit');
        $this->addSql('ALTER TABLE benefit DROP recipient_id');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE used_benefit_date used_benefit_date LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`');
    }
}
