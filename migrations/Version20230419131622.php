<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419131622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE did_you_know (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_did_you_know (user_id INT NOT NULL, did_you_know_id INT NOT NULL, INDEX IDX_2314180AA76ED395 (user_id), INDEX IDX_2314180AE1CB606E (did_you_know_id), PRIMARY KEY(user_id, did_you_know_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_did_you_know ADD CONSTRAINT FK_2314180AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_did_you_know ADD CONSTRAINT FK_2314180AE1CB606E FOREIGN KEY (did_you_know_id) REFERENCES did_you_know (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD want_see_dyk TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_did_you_know DROP FOREIGN KEY FK_2314180AA76ED395');
        $this->addSql('ALTER TABLE user_did_you_know DROP FOREIGN KEY FK_2314180AE1CB606E');
        $this->addSql('DROP TABLE did_you_know');
        $this->addSql('DROP TABLE user_did_you_know');
        $this->addSql('ALTER TABLE `user` DROP want_see_dyk');
    }
}
