<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211120175021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_830F4797C4663E4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino AS SELECT id, page_id, logo, name, method, soft, bonus, license, year, support, short_description, link_to_partner, rating, img_rating, img300 FROM casino');
        $this->addSql('DROP TABLE casino');
        $this->addSql('CREATE TABLE casino (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER DEFAULT NULL, logo CLOB NOT NULL COLLATE BINARY, name VARCHAR(255) NOT NULL COLLATE BINARY, method VARCHAR(255) DEFAULT NULL COLLATE BINARY, soft VARCHAR(255) DEFAULT NULL COLLATE BINARY, bonus VARCHAR(255) DEFAULT NULL COLLATE BINARY, license VARCHAR(255) DEFAULT NULL COLLATE BINARY, year VARCHAR(255) DEFAULT NULL COLLATE BINARY, support VARCHAR(255) DEFAULT NULL COLLATE BINARY, short_description CLOB DEFAULT NULL COLLATE BINARY, link_to_partner CLOB DEFAULT NULL COLLATE BINARY, rating INTEGER DEFAULT 0 NOT NULL, img_rating CLOB DEFAULT NULL COLLATE BINARY, img300 CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_830F4797C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO casino (id, page_id, logo, name, method, soft, bonus, license, year, support, short_description, link_to_partner, rating, img_rating, img300) SELECT id, page_id, logo, name, method, soft, bonus, license, year, support, short_description, link_to_partner, rating, img_rating, img300 FROM __temp__casino');
        $this->addSql('DROP TABLE __temp__casino');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_830F4797C4663E4 ON casino (page_id)');
        $this->addSql('DROP INDEX IDX_1FD77566644465DC');
        $this->addSql('DROP INDEX IDX_1FD7756687F53BF1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_benefits_id INTEGER DEFAULT NULL, casino_limitations_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_1FD77566644465DC FOREIGN KEY (casino_benefits_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1FD7756687F53BF1 FOREIGN KEY (casino_limitations_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO feature (id, casino_benefits_id, casino_limitations_id, type, description) SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('CREATE INDEX IDX_1FD77566644465DC ON feature (casino_benefits_id)');
        $this->addSql('CREATE INDEX IDX_1FD7756687F53BF1 ON feature (casino_limitations_id)');
        $this->addSql('DROP INDEX UNIQ_6FB18553BEF45146');
        $this->addSql('DROP INDEX IDX_6FB18553B19AAF95');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ratings_rate AS SELECT id, casino_id, casino_rating_id, rate FROM ratings_rate');
        $this->addSql('DROP TABLE ratings_rate');
        $this->addSql('CREATE TABLE ratings_rate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_id INTEGER DEFAULT NULL, casino_rating_id INTEGER DEFAULT NULL, rate INTEGER NOT NULL, CONSTRAINT FK_6FB18553B19AAF95 FOREIGN KEY (casino_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6FB18553BEF45146 FOREIGN KEY (casino_rating_id) REFERENCES casino_rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ratings_rate (id, casino_id, casino_rating_id, rate) SELECT id, casino_id, casino_rating_id, rate FROM __temp__ratings_rate');
        $this->addSql('DROP TABLE __temp__ratings_rate');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FB18553BEF45146 ON ratings_rate (casino_rating_id)');
        $this->addSql('CREATE INDEX IDX_6FB18553B19AAF95 ON ratings_rate (casino_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_830F4797C4663E4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino AS SELECT id, page_id, logo, img_rating, img300, name, short_description, link_to_partner, method, soft, bonus, license, year, support, rating FROM casino');
        $this->addSql('DROP TABLE casino');
        $this->addSql('CREATE TABLE casino (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, page_id INTEGER DEFAULT NULL, logo CLOB NOT NULL, img_rating CLOB DEFAULT NULL, img300 CLOB DEFAULT NULL, name VARCHAR(255) NOT NULL, short_description CLOB DEFAULT NULL, link_to_partner CLOB DEFAULT NULL, method VARCHAR(255) DEFAULT NULL, soft VARCHAR(255) DEFAULT NULL, bonus VARCHAR(255) DEFAULT NULL, license VARCHAR(255) DEFAULT NULL, year VARCHAR(255) DEFAULT NULL, support VARCHAR(255) DEFAULT NULL, rating INTEGER DEFAULT 0 NOT NULL)');
        $this->addSql('INSERT INTO casino (id, page_id, logo, img_rating, img300, name, short_description, link_to_partner, method, soft, bonus, license, year, support, rating) SELECT id, page_id, logo, img_rating, img300, name, short_description, link_to_partner, method, soft, bonus, license, year, support, rating FROM __temp__casino');
        $this->addSql('DROP TABLE __temp__casino');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_830F4797C4663E4 ON casino (page_id)');
        $this->addSql('DROP INDEX IDX_1FD77566644465DC');
        $this->addSql('DROP INDEX IDX_1FD7756687F53BF1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_benefits_id INTEGER DEFAULT NULL, casino_limitations_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO feature (id, casino_benefits_id, casino_limitations_id, type, description) SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('CREATE INDEX IDX_1FD77566644465DC ON feature (casino_benefits_id)');
        $this->addSql('CREATE INDEX IDX_1FD7756687F53BF1 ON feature (casino_limitations_id)');
        $this->addSql('DROP INDEX IDX_6FB18553B19AAF95');
        $this->addSql('DROP INDEX UNIQ_6FB18553BEF45146');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ratings_rate AS SELECT id, casino_id, casino_rating_id, rate FROM ratings_rate');
        $this->addSql('DROP TABLE ratings_rate');
        $this->addSql('CREATE TABLE ratings_rate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_id INTEGER NOT NULL, casino_rating_id INTEGER DEFAULT NULL, rate INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ratings_rate (id, casino_id, casino_rating_id, rate) SELECT id, casino_id, casino_rating_id, rate FROM __temp__ratings_rate');
        $this->addSql('DROP TABLE __temp__ratings_rate');
        $this->addSql('CREATE INDEX IDX_6FB18553B19AAF95 ON ratings_rate (casino_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FB18553BEF45146 ON ratings_rate (casino_rating_id)');
    }
}
