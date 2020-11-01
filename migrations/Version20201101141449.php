<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101141449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD slug VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168A21214B7 ON articles (categories_id)');
        $this->addSql('CREATE INDEX IDX_BFDD316867B3B43D ON articles (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A21214B7');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316867B3B43D');
        $this->addSql('DROP INDEX IDX_BFDD3168A21214B7 ON articles');
        $this->addSql('DROP INDEX IDX_BFDD316867B3B43D ON articles');
        $this->addSql('ALTER TABLE articles DROP slug, DROP created_at, DROP active');
    }
}
