<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011085939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_vols_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, dateachat DATE NOT NULL, INDEX IDX_26A9845679F37AE5 (id_user_id), INDEX IDX_26A9845689A3A78C (id_vols_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_B6BD307F79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vols (id INT AUTO_INCREMENT NOT NULL, id_company_id INT DEFAULT NULL, depart DATE NOT NULL, destination VARCHAR(255) NOT NULL, datederetour DATE NOT NULL, tarif DOUBLE PRECISION NOT NULL, INDEX IDX_2CDFA86C32119A01 (id_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845689A3A78C FOREIGN KEY (id_vols_id) REFERENCES vols (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vols ADD CONSTRAINT FK_2CDFA86C32119A01 FOREIGN KEY (id_company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845679F37AE5');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845689A3A78C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F79F37AE5');
        $this->addSql('ALTER TABLE vols DROP FOREIGN KEY FK_2CDFA86C32119A01');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE vols');
    }
}
