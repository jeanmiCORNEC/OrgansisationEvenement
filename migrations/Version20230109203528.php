<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109203528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_salle (atelier_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_77544A1782E2CF35 (atelier_id), INDEX IDX_77544A17DC304035 (salle_id), PRIMARY KEY(atelier_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_user (atelier_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4D145FAA82E2CF35 (atelier_id), INDEX IDX_4D145FAAA76ED395 (user_id), PRIMARY KEY(atelier_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement_user (evenement_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2EC0B3C4FD02F13 (evenement_id), INDEX IDX_2EC0B3C4A76ED395 (user_id), PRIMARY KEY(evenement_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_user (salle_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_30139FC9DC304035 (salle_id), INDEX IDX_30139FC9A76ED395 (user_id), PRIMARY KEY(salle_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier_salle ADD CONSTRAINT FK_77544A1782E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_salle ADD CONSTRAINT FK_77544A17DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_user ADD CONSTRAINT FK_4D145FAA82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_user ADD CONSTRAINT FK_4D145FAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_user ADD CONSTRAINT FK_2EC0B3C4FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_user ADD CONSTRAINT FK_2EC0B3C4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_user ADD CONSTRAINT FK_30139FC9DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_user ADD CONSTRAINT FK_30139FC9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier ADD evenement_id INT NOT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823FD02F13 ON atelier (evenement_id)');
        $this->addSql('ALTER TABLE salle ADD evenement_id INT NOT NULL, DROP options');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5CFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_4E977E5CFD02F13 ON salle (evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier_salle DROP FOREIGN KEY FK_77544A1782E2CF35');
        $this->addSql('ALTER TABLE atelier_salle DROP FOREIGN KEY FK_77544A17DC304035');
        $this->addSql('ALTER TABLE atelier_user DROP FOREIGN KEY FK_4D145FAA82E2CF35');
        $this->addSql('ALTER TABLE atelier_user DROP FOREIGN KEY FK_4D145FAAA76ED395');
        $this->addSql('ALTER TABLE evenement_user DROP FOREIGN KEY FK_2EC0B3C4FD02F13');
        $this->addSql('ALTER TABLE evenement_user DROP FOREIGN KEY FK_2EC0B3C4A76ED395');
        $this->addSql('ALTER TABLE salle_user DROP FOREIGN KEY FK_30139FC9DC304035');
        $this->addSql('ALTER TABLE salle_user DROP FOREIGN KEY FK_30139FC9A76ED395');
        $this->addSql('DROP TABLE atelier_salle');
        $this->addSql('DROP TABLE atelier_user');
        $this->addSql('DROP TABLE evenement_user');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE salle_user');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823FD02F13');
        $this->addSql('DROP INDEX IDX_E1BB1823FD02F13 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP evenement_id');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5CFD02F13');
        $this->addSql('DROP INDEX IDX_4E977E5CFD02F13 ON salle');
        $this->addSql('ALTER TABLE salle ADD options VARCHAR(255) DEFAULT NULL, DROP evenement_id');
    }
}
