<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109163317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casino (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER NOT NULL, logo CLOB NOT NULL, name VARCHAR(255) NOT NULL, method VARCHAR(255) DEFAULT NULL, soft VARCHAR(255) DEFAULT NULL, bonus VARCHAR(255) DEFAULT NULL, license VARCHAR(255) DEFAULT NULL, year VARCHAR(255) DEFAULT NULL, support VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_830F4797C4663E4 ON casino (page_id)');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, keywords CLOB NOT NULL, addition CLOB DEFAULT NULL, content1 CLOB NOT NULL, content2 CLOB NOT NULL, content_table CLOB DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE casino');
        $this->addSql('DROP TABLE page');
    }
}
