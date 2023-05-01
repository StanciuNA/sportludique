<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230429185948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_product (cart_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(cart_id, product_id), CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2890CCAA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2890CCAA1AD5CDBF ON cart_product (cart_id)');
        $this->addSql('CREATE INDEX IDX_2890CCAA4584665A ON cart_product (product_id)');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, id_person_id, date FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_person_id INTEGER NOT NULL, product_id_id INTEGER NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_BA388B7A14E0760 FOREIGN KEY (id_person_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BA388B7DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart (id, id_person_id, date) SELECT id, id_person_id, date FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE INDEX IDX_BA388B7A14E0760 ON cart (id_person_id)');
        $this->addSql('CREATE INDEX IDX_BA388B7DE18E50B ON cart (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_product_id INTEGER NOT NULL, id_order_id INTEGER NOT NULL, CONSTRAINT FK_8BF99E2E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8BF99E2DD4481AD FOREIGN KEY (id_order_id) REFERENCES "order" (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8BF99E2DD4481AD ON order_content (id_order_id)');
        $this->addSql('CREATE INDEX IDX_8BF99E2E00EE68D ON order_content (id_product_id)');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cart AS SELECT id, id_person_id, date FROM cart');
        $this->addSql('DROP TABLE cart');
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_person_id INTEGER NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_BA388B7A14E0760 FOREIGN KEY (id_person_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cart (id, id_person_id, date) SELECT id, id_person_id, date FROM __temp__cart');
        $this->addSql('DROP TABLE __temp__cart');
        $this->addSql('CREATE INDEX IDX_BA388B7A14E0760 ON cart (id_person_id)');
    }
}
