<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606093430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_content');
        $this->addSql('ALTER TABLE adress ADD COLUMN firstname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE adress ADD COLUMN name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE adress ADD COLUMN email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, label, image FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categ_parent_id INTEGER DEFAULT NULL, label VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_64C19C1FA7DCF88 FOREIGN KEY (categ_parent_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO category (id, label, image) SELECT id, label, image FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
        $this->addSql('CREATE INDEX IDX_64C19C1FA7DCF88 ON category (categ_parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_product_id INTEGER NOT NULL, id_order_id INTEGER NOT NULL, CONSTRAINT FK_8BF99E2E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8BF99E2DD4481AD FOREIGN KEY (id_order_id) REFERENCES "order" (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8BF99E2DD4481AD ON order_content (id_order_id)');
        $this->addSql('CREATE INDEX IDX_8BF99E2E00EE68D ON order_content (id_product_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__adress AS SELECT id, id_user_id, street, city, pc FROM adress');
        $this->addSql('DROP TABLE adress');
        $this->addSql('CREATE TABLE adress (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, pc INTEGER NOT NULL, CONSTRAINT FK_5CECC7BE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO adress (id, id_user_id, street, city, pc) SELECT id, id_user_id, street, city, pc FROM __temp__adress');
        $this->addSql('DROP TABLE __temp__adress');
        $this->addSql('CREATE INDEX IDX_5CECC7BE79F37AE5 ON adress (id_user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category AS SELECT id, label, image FROM category');
        $this->addSql('DROP TABLE category');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO category (id, label, image) SELECT id, label, image FROM __temp__category');
        $this->addSql('DROP TABLE __temp__category');
    }
}
