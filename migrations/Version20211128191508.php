<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128191508 extends AbstractMigration
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino_rating AS SELECT id, name, slug, title, description, keywords, addition, content1, content2, active FROM casino_rating');
        $this->addSql('DROP TABLE casino_rating');
        $this->addSql('CREATE TABLE casino_rating (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, keywords CLOB NOT NULL, addition CLOB DEFAULT NULL COLLATE BINARY, content1 CLOB NOT NULL, content2 CLOB NOT NULL, active BOOLEAN DEFAULT \'1\')');
        $this->addSql('INSERT INTO casino_rating (id, name, slug, title, description, keywords, addition, content1, content2, active) SELECT id, name, slug, title, description, keywords, addition, content1, content2, active FROM __temp__casino_rating');
        $this->addSql('DROP TABLE __temp__casino_rating');
        $this->addSql('DROP INDEX IDX_1FD77566644465DC');
        $this->addSql('DROP INDEX IDX_1FD7756687F53BF1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_benefits_id INTEGER DEFAULT NULL, casino_limitations_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_1FD77566644465DC FOREIGN KEY (casino_benefits_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1FD7756687F53BF1 FOREIGN KEY (casino_limitations_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO feature (id, casino_benefits_id, casino_limitations_id, type, description) SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('CREATE INDEX IDX_1FD77566644465DC ON feature (casino_benefits_id)');
        $this->addSql('CREATE INDEX IDX_1FD7756687F53BF1 ON feature (casino_limitations_id)');
        $this->addSql('DROP INDEX IDX_FBC69240F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__form_field_reference AS SELECT id, author_id FROM form_field_reference');
        $this->addSql('DROP TABLE form_field_reference');
        $this->addSql('CREATE TABLE form_field_reference (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, CONSTRAINT FK_FBC69240F675F31B FOREIGN KEY (author_id) REFERENCES symfony_demo_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO form_field_reference (id, author_id) SELECT id, author_id FROM __temp__form_field_reference');
        $this->addSql('DROP TABLE __temp__form_field_reference');
        $this->addSql('CREATE INDEX IDX_FBC69240F675F31B ON form_field_reference (author_id)');
        $this->addSql('DROP INDEX IDX_6FB18553B19AAF95');
        $this->addSql('DROP INDEX IDX_6FB18553BEF45146');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ratings_rate AS SELECT id, casino_id, casino_rating_id, rate FROM ratings_rate');
        $this->addSql('DROP TABLE ratings_rate');
        $this->addSql('CREATE TABLE ratings_rate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_id INTEGER DEFAULT NULL, casino_rating_id INTEGER DEFAULT NULL, rate INTEGER NOT NULL, CONSTRAINT FK_6FB18553B19AAF95 FOREIGN KEY (casino_id) REFERENCES casino (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6FB18553BEF45146 FOREIGN KEY (casino_rating_id) REFERENCES casino_rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ratings_rate (id, casino_id, casino_rating_id, rate) SELECT id, casino_id, casino_rating_id, rate FROM __temp__ratings_rate');
        $this->addSql('DROP TABLE __temp__ratings_rate');
        $this->addSql('CREATE INDEX IDX_6FB18553B19AAF95 ON ratings_rate (casino_id)');
        $this->addSql('CREATE INDEX IDX_6FB18553BEF45146 ON ratings_rate (casino_rating_id)');
        $this->addSql('DROP INDEX IDX_53AD8F834B89032C');
        $this->addSql('DROP INDEX IDX_53AD8F83F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_comment AS SELECT id, post_id, author_id, content, published_at FROM symfony_demo_comment');
        $this->addSql('DROP TABLE symfony_demo_comment');
        $this->addSql('CREATE TABLE symfony_demo_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE BINARY, published_at DATETIME NOT NULL, CONSTRAINT FK_53AD8F834B89032C FOREIGN KEY (post_id) REFERENCES symfony_demo_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_53AD8F83F675F31B FOREIGN KEY (author_id) REFERENCES symfony_demo_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfony_demo_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__symfony_demo_comment');
        $this->addSql('DROP TABLE __temp__symfony_demo_comment');
        $this->addSql('CREATE INDEX IDX_53AD8F834B89032C ON symfony_demo_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_53AD8F83F675F31B ON symfony_demo_comment (author_id)');
        $this->addSql('DROP INDEX IDX_58A92E65F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post AS SELECT id, author_id, title, slug, summary, content, published_at FROM symfony_demo_post');
        $this->addSql('DROP TABLE symfony_demo_post');
        $this->addSql('CREATE TABLE symfony_demo_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, summary VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, published_at DATETIME NOT NULL, image VARCHAR(255) default NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_58A92E65F675F31B FOREIGN KEY (author_id) REFERENCES symfony_demo_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfony_demo_post (id, author_id, title, slug, summary, content, published_at) SELECT id, author_id, title, slug, summary, content, published_at FROM __temp__symfony_demo_post');
        $this->addSql('DROP TABLE __temp__symfony_demo_post');
        $this->addSql('CREATE INDEX IDX_58A92E65F675F31B ON symfony_demo_post (author_id)');
        $this->addSql('DROP INDEX IDX_6ABC1CC44B89032C');
        $this->addSql('DROP INDEX IDX_6ABC1CC4BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post_tag AS SELECT post_id, tag_id FROM symfony_demo_post_tag');
        $this->addSql('DROP TABLE symfony_demo_post_tag');
        $this->addSql('CREATE TABLE symfony_demo_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id), CONSTRAINT FK_6ABC1CC44B89032C FOREIGN KEY (post_id) REFERENCES symfony_demo_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6ABC1CC4BAD26311 FOREIGN KEY (tag_id) REFERENCES symfony_demo_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfony_demo_post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__symfony_demo_post_tag');
        $this->addSql('DROP TABLE __temp__symfony_demo_post_tag');
        $this->addSql('CREATE INDEX IDX_6ABC1CC44B89032C ON symfony_demo_post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4BAD26311 ON symfony_demo_post_tag (tag_id)');
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__casino_rating AS SELECT id, name, slug, title, description, keywords, addition, content1, content2, active FROM casino_rating');
        $this->addSql('DROP TABLE casino_rating');
        $this->addSql('CREATE TABLE casino_rating (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL, slug VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, keywords CLOB DEFAULT NULL COLLATE BINARY, addition CLOB DEFAULT NULL, content1 CLOB DEFAULT NULL COLLATE BINARY, content2 CLOB DEFAULT NULL COLLATE BINARY, active BOOLEAN DEFAULT \'1\')');
        $this->addSql('INSERT INTO casino_rating (id, name, slug, title, description, keywords, addition, content1, content2, active) SELECT id, name, slug, title, description, keywords, addition, content1, content2, active FROM __temp__casino_rating');
        $this->addSql('DROP TABLE __temp__casino_rating');
        $this->addSql('DROP INDEX IDX_1FD77566644465DC');
        $this->addSql('DROP INDEX IDX_1FD7756687F53BF1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__feature AS SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM feature');
        $this->addSql('DROP TABLE feature');
        $this->addSql('CREATE TABLE feature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_benefits_id INTEGER DEFAULT NULL, casino_limitations_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO feature (id, casino_benefits_id, casino_limitations_id, type, description) SELECT id, casino_benefits_id, casino_limitations_id, type, description FROM __temp__feature');
        $this->addSql('DROP TABLE __temp__feature');
        $this->addSql('CREATE INDEX IDX_1FD77566644465DC ON feature (casino_benefits_id)');
        $this->addSql('CREATE INDEX IDX_1FD7756687F53BF1 ON feature (casino_limitations_id)');
        $this->addSql('DROP INDEX IDX_FBC69240F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__form_field_reference AS SELECT id, author_id FROM form_field_reference');
        $this->addSql('DROP TABLE form_field_reference');
        $this->addSql('CREATE TABLE form_field_reference (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO form_field_reference (id, author_id) SELECT id, author_id FROM __temp__form_field_reference');
        $this->addSql('DROP TABLE __temp__form_field_reference');
        $this->addSql('CREATE INDEX IDX_FBC69240F675F31B ON form_field_reference (author_id)');
        $this->addSql('DROP INDEX IDX_6FB18553B19AAF95');
        $this->addSql('DROP INDEX IDX_6FB18553BEF45146');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ratings_rate AS SELECT id, casino_id, casino_rating_id, rate FROM ratings_rate');
        $this->addSql('DROP TABLE ratings_rate');
        $this->addSql('CREATE TABLE ratings_rate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, casino_id INTEGER DEFAULT NULL, casino_rating_id INTEGER DEFAULT NULL, rate INTEGER NOT NULL)');
        $this->addSql('INSERT INTO ratings_rate (id, casino_id, casino_rating_id, rate) SELECT id, casino_id, casino_rating_id, rate FROM __temp__ratings_rate');
        $this->addSql('DROP TABLE __temp__ratings_rate');
        $this->addSql('CREATE INDEX IDX_6FB18553B19AAF95 ON ratings_rate (casino_id)');
        $this->addSql('CREATE INDEX IDX_6FB18553BEF45146 ON ratings_rate (casino_rating_id)');
        $this->addSql('DROP INDEX IDX_53AD8F834B89032C');
        $this->addSql('DROP INDEX IDX_53AD8F83F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_comment AS SELECT id, post_id, author_id, content, published_at FROM symfony_demo_comment');
        $this->addSql('DROP TABLE symfony_demo_comment');
        $this->addSql('CREATE TABLE symfony_demo_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO symfony_demo_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__symfony_demo_comment');
        $this->addSql('DROP TABLE __temp__symfony_demo_comment');
        $this->addSql('CREATE INDEX IDX_53AD8F834B89032C ON symfony_demo_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_53AD8F83F675F31B ON symfony_demo_comment (author_id)');
        $this->addSql('DROP INDEX IDX_58A92E65F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post AS SELECT id, author_id, title, slug, summary, content, published_at FROM symfony_demo_post');
        $this->addSql('DROP TABLE symfony_demo_post');
        $this->addSql('CREATE TABLE symfony_demo_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO symfony_demo_post (id, author_id, title, slug, summary, content, published_at) SELECT id, author_id, title, slug, summary, content, published_at FROM __temp__symfony_demo_post');
        $this->addSql('DROP TABLE __temp__symfony_demo_post');
        $this->addSql('CREATE INDEX IDX_58A92E65F675F31B ON symfony_demo_post (author_id)');
        $this->addSql('DROP INDEX IDX_6ABC1CC44B89032C');
        $this->addSql('DROP INDEX IDX_6ABC1CC4BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post_tag AS SELECT post_id, tag_id FROM symfony_demo_post_tag');
        $this->addSql('DROP TABLE symfony_demo_post_tag');
        $this->addSql('CREATE TABLE symfony_demo_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('INSERT INTO symfony_demo_post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__symfony_demo_post_tag');
        $this->addSql('DROP TABLE __temp__symfony_demo_post_tag');
        $this->addSql('CREATE INDEX IDX_6ABC1CC44B89032C ON symfony_demo_post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4BAD26311 ON symfony_demo_post_tag (tag_id)');
    }
}
