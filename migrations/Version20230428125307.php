<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428125307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_benefit (user_id INT NOT NULL, benefit_id INT NOT NULL, INDEX IDX_4861E15A76ED395 (user_id), INDEX IDX_4861E15B517B89 (benefit_id), PRIMARY KEY(user_id, benefit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_benefit ADD CONSTRAINT FK_4861E15A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_benefit ADD CONSTRAINT FK_4861E15B517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benefit ADD image LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD used_benefit_date JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_benefit DROP FOREIGN KEY FK_4861E15A76ED395');
        $this->addSql('ALTER TABLE user_benefit DROP FOREIGN KEY FK_4861E15B517B89');
        $this->addSql('DROP TABLE user_benefit');
        $this->addSql('ALTER TABLE benefit DROP image');
        $this->addSql('ALTER TABLE `user` DROP used_benefit_date');
    }
}
