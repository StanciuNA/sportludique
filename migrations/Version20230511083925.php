<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511083925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_content');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, id_person_id, date FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_person_id INTEGER NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_BA388B7A14E0760 FOREIGN KEY (id_person_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart (id, id_person_id, date) SELECT id, id_person_id, date FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE INDEX IDX_BA388B7A14E0760 ON cart (id_person_id)');
        $this->addSql('ALTER TABLE "order" ADD COLUMN total_price DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_product_id INTEGER NOT NULL, id_order_id INTEGER NOT NULL, CONSTRAINT FK_8BF99E2E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8BF99E2DD4481AD FOREIGN KEY (id_order_id) REFERENCES "order" (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8BF99E2DD4481AD ON order_content (id_order_id)');
        $this->addSql('CREATE INDEX IDX_8BF99E2E00EE68D ON order_content (id_product_id)');
        $this->addSql('ALTER TABLE cart ADD COLUMN total_price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order AS SELECT id, id_status_id, payment_id, adress_id, cart_id, date, amount FROM "order"');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_status_id INTEGER NOT NULL, payment_id INTEGER NOT NULL, adress_id INTEGER NOT NULL, cart_id INTEGER NOT NULL, date DATETIME NOT NULL, amount BIGINT NOT NULL, CONSTRAINT FK_F5299398EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993984C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993988486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "order" (id, id_status_id, payment_id, adress_id, cart_id, date, amount) SELECT id, id_status_id, payment_id, adress_id, cart_id, date, amount FROM __temp__order');
        $this->addSql('DROP TABLE __temp__order');
        $this->addSql('CREATE INDEX IDX_F5299398EBC2BC9A ON "order" (id_status_id)');
        $this->addSql('CREATE INDEX IDX_F52993984C3A3BB ON "order" (payment_id)');
        $this->addSql('CREATE INDEX IDX_F52993988486F9AC ON "order" (adress_id)');
        $this->addSql('CREATE INDEX IDX_F52993981AD5CDBF ON "order" (cart_id)');
    }
}
