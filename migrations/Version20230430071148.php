<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430071148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_content AS SELECT id, cart_id_id, quantity FROM cart_content');
        $this->addSql('DROP TABLE cart_content');
        $this->addSql('CREATE TABLE cart_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id_id INTEGER NOT NULL, product_id_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_51FF8AE20AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_51FF8AEDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_content (id, cart_id_id, quantity) SELECT id, cart_id_id, quantity FROM __temp__cart_content');
        $this->addSql('DROP TABLE __temp__cart_content');
        $this->addSql('CREATE INDEX IDX_51FF8AE20AEF35F ON cart_content (cart_id_id)');
        $this->addSql('CREATE INDEX IDX_51FF8AEDE18E50B ON cart_content (product_id_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, id_category_id, nom, price, description, stock, image FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_category_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, stock INTEGER NOT NULL, image CLOB DEFAULT NULL, CONSTRAINT FK_D34A04ADA545015 FOREIGN KEY (id_category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, id_category_id, nom, price, description, stock, image) SELECT id, id_category_id, nom, price, description, stock, image FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04ADA545015 ON product (id_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_content AS SELECT id, cart_id_id, quantity FROM cart_content');
        $this->addSql('DROP TABLE cart_content');
        $this->addSql('CREATE TABLE cart_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_51FF8AE20AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_content (id, cart_id_id, quantity) SELECT id, cart_id_id, quantity FROM __temp__cart_content');
        $this->addSql('DROP TABLE __temp__cart_content');
        $this->addSql('CREATE INDEX IDX_51FF8AE20AEF35F ON cart_content (cart_id_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, id_category_id, nom, price, description, stock, image FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_category_id INTEGER NOT NULL, cart_content_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, stock INTEGER NOT NULL, image CLOB DEFAULT NULL, CONSTRAINT FK_D34A04ADA545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D34A04ADE4CAD31F FOREIGN KEY (cart_content_id) REFERENCES cart_content (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, id_category_id, nom, price, description, stock, image) SELECT id, id_category_id, nom, price, description, stock, image FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04ADA545015 ON product (id_category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADE4CAD31F ON product (cart_content_id)');
    }
}
