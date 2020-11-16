<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110153427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consoles_minis (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, manufacturer VARCHAR(255) NOT NULL, new_price INT NOT NULL, used_price INT NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, manufactured_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_consoles_mini (id INT AUTO_INCREMENT NOT NULL, consolesminis_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A71E7FE247822D05 (consolesminis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images_consoles_mini ADD CONSTRAINT FK_A71E7FE247822D05 FOREIGN KEY (consolesminis_id) REFERENCES consoles_minis (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images_consoles_mini DROP FOREIGN KEY FK_A71E7FE247822D05');
        $this->addSql('DROP TABLE consoles_minis');
        $this->addSql('DROP TABLE images_consoles_mini');
    }
}
