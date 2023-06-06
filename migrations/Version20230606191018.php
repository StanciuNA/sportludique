<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606191018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_content AS SELECT id, cart_id_id, product_id_id, quantity FROM cart_content');
        $this->addSql('DROP TABLE cart_content');
        $this->addSql('CREATE TABLE cart_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id_id INTEGER NOT NULL, product_id_id INTEGER NOT NULL, purchase_id INTEGER DEFAULT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_51FF8AE20AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_51FF8AEDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_51FF8AE558FBEB9 FOREIGN KEY (purchase_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_content (id, cart_id_id, product_id_id, quantity) SELECT id, cart_id_id, product_id_id, quantity FROM __temp__cart_content');
        $this->addSql('DROP TABLE __temp__cart_content');
        $this->addSql('CREATE INDEX IDX_51FF8AEDE18E50B ON cart_content (product_id_id)');
        $this->addSql('CREATE INDEX IDX_51FF8AE20AEF35F ON cart_content (cart_id_id)');
        $this->addSql('CREATE INDEX IDX_51FF8AE558FBEB9 ON cart_content (purchase_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, id_status_id, payment_id, adress_id, date, amount FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_status_id INTEGER NOT NULL, payment_id INTEGER NOT NULL, adress_id INTEGER NOT NULL, date DATETIME NOT NULL, amount BIGINT NOT NULL, total_price DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_F5299398EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993988486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, id_status_id, payment_id, adress_id, date, amount) SELECT id, id_status_id, payment_id, adress_id, date, amount FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F52993988486F9AC ON "order" (adress_id)');
        $this->addSql('CREATE INDEX IDX_F52993984C3A3BB ON "order" (payment_id)');
        $this->addSql('CREATE INDEX IDX_F5299398EBC2BC9A ON "order" (id_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart_content AS SELECT id, cart_id_id, product_id_id, quantity FROM cart_content');
        $this->addSql('DROP TABLE cart_content');
        $this->addSql('CREATE TABLE cart_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id_id INTEGER NOT NULL, product_id_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_51FF8AE20AEF35F FOREIGN KEY (cart_id_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_51FF8AEDE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart_content (id, cart_id_id, product_id_id, quantity) SELECT id, cart_id_id, product_id_id, quantity FROM __temp__cart_content');
        $this->addSql('DROP TABLE __temp__cart_content');
        $this->addSql('CREATE INDEX IDX_51FF8AE20AEF35F ON cart_content (cart_id_id)');
        $this->addSql('CREATE INDEX IDX_51FF8AEDE18E50B ON cart_content (product_id_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, id_status_id, payment_id, adress_id, date, amount FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_status_id INTEGER NOT NULL, payment_id INTEGER NOT NULL, adress_id INTEGER NOT NULL, cart_id INTEGER NOT NULL, date DATETIME NOT NULL, amount BIGINT NOT NULL, CONSTRAINT FK_F5299398EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993988486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, id_status_id, payment_id, adress_id, date, amount) SELECT id, id_status_id, payment_id, adress_id, date, amount FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398EBC2BC9A ON "order" (id_status_id)');
        $this->addSql('CREATE INDEX IDX_F52993984C3A3BB ON "order" (payment_id)');
        $this->addSql('CREATE INDEX IDX_F52993988486F9AC ON "order" (adress_id)');
        $this->addSql('CREATE INDEX IDX_F52993981AD5CDBF ON "order" (cart_id)');
    }
}
