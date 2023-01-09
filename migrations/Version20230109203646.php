<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109203646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salle_option (salle_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_6E05DC4FDC304035 (salle_id), INDEX IDX_6E05DC4FA7C41D6F (option_id), PRIMARY KEY(salle_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salle_option ADD CONSTRAINT FK_6E05DC4FDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_option ADD CONSTRAINT FK_6E05DC4FA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salle_option DROP FOREIGN KEY FK_6E05DC4FDC304035');
        $this->addSql('ALTER TABLE salle_option DROP FOREIGN KEY FK_6E05DC4FA7C41D6F');
        $this->addSql('DROP TABLE salle_option');
    }
}
