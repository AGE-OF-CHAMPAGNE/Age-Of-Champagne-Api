<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413104900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_vintage (user_id INT NOT NULL, vintage_id INT NOT NULL, INDEX IDX_F90C4DB0A76ED395 (user_id), INDEX IDX_F90C4DB048198056 (vintage_id), PRIMARY KEY(user_id, vintage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_vintage ADD CONSTRAINT FK_F90C4DB0A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_vintage ADD CONSTRAINT FK_F90C4DB048198056 FOREIGN KEY (vintage_id) REFERENCES vintage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vintage DROP FOREIGN KEY FK_A10153BA67B3B43D');
        $this->addSql('DROP INDEX IDX_A10153BA67B3B43D ON vintage');
        $this->addSql('ALTER TABLE vintage DROP users_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_vintage DROP FOREIGN KEY FK_F90C4DB0A76ED395');
        $this->addSql('ALTER TABLE user_vintage DROP FOREIGN KEY FK_F90C4DB048198056');
        $this->addSql('DROP TABLE user_vintage');
        $this->addSql('ALTER TABLE vintage ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vintage ADD CONSTRAINT FK_A10153BA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A10153BA67B3B43D ON vintage (users_id)');
    }
}
