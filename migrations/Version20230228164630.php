<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228164630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_status_id INTEGER NOT NULL, id_person_id INTEGER NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_F5299398EBC2BC9A FOREIGN KEY (id_status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F5299398A14E0760 FOREIGN KEY (id_person_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F5299398EBC2BC9A ON "order" (id_status_id)');
        $this->addSql('CREATE INDEX IDX_F5299398A14E0760 ON "order" (id_person_id)');
        $this->addSql('CREATE TABLE order_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_product_id INTEGER NOT NULL, id_order_id INTEGER NOT NULL, CONSTRAINT FK_8BF99E2E00EE68D FOREIGN KEY (id_product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8BF99E2DD4481AD FOREIGN KEY (id_order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8BF99E2E00EE68D ON order_content (id_product_id)');
        $this->addSql('CREATE INDEX IDX_8BF99E2DD4481AD ON order_content (id_order_id)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_category_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, stock INTEGER NOT NULL, image CLOB DEFAULT NULL, CONSTRAINT FK_D34A04ADA545015 FOREIGN KEY (id_category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA545015 ON product (id_category_id)');
        $this->addSql('CREATE TABLE status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE type_of_person (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_type_of_person_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, date_creation DATETIME DEFAULT NULL, is_verified BOOLEAN NOT NULL, CONSTRAINT FK_8D93D649606BC953 FOREIGN KEY (id_type_of_person_id) REFERENCES type_of_person (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649606BC953 ON user (id_type_of_person_id)');
        $this->addSql('CREATE TABLE "view" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description CLOB NOT NULL, mark DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_of_person');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE "view"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
