<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109180932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_830F4797C4663E4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino AS SELECT id, page_id, logo, name, method, soft, bonus, license, year, support FROM casino');
        $this->addSql('DROP TABLE casino');
        $this->addSql('CREATE TABLE casino (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER DEFAULT NULL, logo CLOB NOT NULL COLLATE BINARY, name VARCHAR(255) NOT NULL COLLATE BINARY, method VARCHAR(255) DEFAULT NULL COLLATE BINARY, soft VARCHAR(255) DEFAULT NULL COLLATE BINARY, bonus VARCHAR(255) DEFAULT NULL COLLATE BINARY, license VARCHAR(255) DEFAULT NULL COLLATE BINARY, year VARCHAR(255) DEFAULT NULL COLLATE BINARY, support VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_830F4797C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO casino (id, page_id, logo, name, method, soft, bonus, license, year, support) SELECT id, page_id, logo, name, method, soft, bonus, license, year, support FROM __temp__casino');
        $this->addSql('DROP TABLE __temp__casino');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_830F4797C4663E4 ON casino (page_id)');
        $this->addSql('ALTER TABLE page ADD COLUMN main BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_830F4797C4663E4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino AS SELECT id, page_id, logo, name, method, soft, bonus, license, year, support FROM casino');
        $this->addSql('DROP TABLE casino');
        $this->addSql('CREATE TABLE casino (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER DEFAULT NULL, logo CLOB NOT NULL, name VARCHAR(255) NOT NULL, method VARCHAR(255) DEFAULT NULL, soft VARCHAR(255) DEFAULT NULL, bonus VARCHAR(255) DEFAULT NULL, license VARCHAR(255) DEFAULT NULL, year VARCHAR(255) DEFAULT NULL, support VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO casino (id, page_id, logo, name, method, soft, bonus, license, year, support) SELECT id, page_id, logo, name, method, soft, bonus, license, year, support FROM __temp__casino');
        $this->addSql('DROP TABLE __temp__casino');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_830F4797C4663E4 ON casino (page_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page AS SELECT id, title, description, keywords, addition, content1, content2, content_table FROM page');
        $this->addSql('DROP TABLE page');
        $this->addSql('CREATE TABLE page (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, keywords CLOB NOT NULL, addition CLOB DEFAULT NULL, content1 CLOB NOT NULL, content2 CLOB NOT NULL, content_table CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO page (id, title, description, keywords, addition, content1, content2, content_table) SELECT id, title, description, keywords, addition, content1, content2, content_table FROM __temp__page');
        $this->addSql('DROP TABLE __temp__page');
    }
}
