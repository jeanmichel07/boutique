<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220317100633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assit_appointment DROP FOREIGN KEY FK_5FB53060E5B533F9');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F312469DE2');
        $this->addSql('ALTER TABLE study DROP FOREIGN KEY FK_E67F9749579F4768');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B33E1689A');
        $this->addSql('ALTER TABLE order_invoice DROP FOREIGN KEY FK_661FBE0F33E1689A');
        $this->addSql('ALTER TABLE order_invoice_line DROP FOREIGN KEY FK_D71142F9A21126A1');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52ECDF80196');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BCDF80196');
        $this->addSql('ALTER TABLE qcm DROP FOREIGN KEY FK_D7A1FEF4CDF80196');
        $this->addSql('ALTER TABLE order_invoice_line DROP FOREIGN KEY FK_D71142F99A530CA8');
        $this->addSql('ALTER TABLE qcm_question DROP FOREIGN KEY FK_572B6C8DFF6241A6');
        $this->addSql('ALTER TABLE response_selected_by_user DROP FOREIGN KEY FK_73F5D384FF6241A6');
        $this->addSql('ALTER TABLE qcm_response_choice DROP FOREIGN KEY FK_2282D82BEA58905F');
        $this->addSql('ALTER TABLE response_selected_by_user DROP FOREIGN KEY FK_73F5D384EA58905F');
        $this->addSql('ALTER TABLE response_selected_by_user DROP FOREIGN KEY FK_73F5D384180EC108');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499D419299');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE assit_appointment');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_line');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE order_invoice');
        $this->addSql('DROP TABLE order_invoice_line');
        $this->addSql('DROP TABLE qcm');
        $this->addSql('DROP TABLE qcm_question');
        $this->addSql('DROP TABLE qcm_response_choice');
        $this->addSql('DROP TABLE response_selected_by_user');
        $this->addSql('DROP TABLE study');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP INDEX IDX_8D93D6499D419299 ON user');
        $this->addSql('ALTER TABLE user DROP user_type_id, DROP username, DROP last_name, DROP first_name, DROP phone, DROP description, DROP is_verified, DROP created_at, DROP updated_at, DROP status');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, appointement_date DATETIME NOT NULL, link VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_FE38F844A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE assit_appointment (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, appointment_id INT DEFAULT NULL, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_5FB53060E5B533F9 (appointment_id), INDEX IDX_5FB53060A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, lesson_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, doc_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, media_file VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_F981B52ECDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, num VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price_ht NUMERIC(10, 2) NOT NULL, price_ttc NUMERIC(10, 2) NOT NULL, vat DOUBLE PRECISION NOT NULL, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_8ECAEAD4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE command_line (id INT AUTO_INCREMENT NOT NULL, command_id INT DEFAULT NULL, lesson_id INT DEFAULT NULL, price_ht NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_70BE1A7BCDF80196 (lesson_id), INDEX IDX_70BE1A7B33E1689A (command_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, price NUMERIC(10, 2) DEFAULT NULL, is_free TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_F87474F312469DE2 (category_id), INDEX IDX_F87474F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_invoice (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, command_id INT DEFAULT NULL, number VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, total_discount_tax_excel NUMERIC(10, 2) DEFAULT NULL, total_discount_tax_incl NUMERIC(10, 2) DEFAULT NULL, total_paid_tax_excl NUMERIC(10, 2) DEFAULT NULL, total_paid_tax_incl NUMERIC(10, 2) DEFAULT NULL, total_products NUMERIC(10, 2) DEFAULT NULL, total_products_wt NUMERIC(10, 2) DEFAULT NULL, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_661FBE0F33E1689A (command_id), INDEX IDX_661FBE0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_invoice_line (id INT AUTO_INCREMENT NOT NULL, order_invoice_id INT DEFAULT NULL, command_line_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_D71142F9A21126A1 (command_line_id), INDEX IDX_D71142F99A530CA8 (order_invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE qcm (id INT AUTO_INCREMENT NOT NULL, lesson_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_D7A1FEF4CDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE qcm_question (id INT AUTO_INCREMENT NOT NULL, qcm_id INT DEFAULT NULL, question LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_572B6C8DFF6241A6 (qcm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE qcm_response_choice (id INT AUTO_INCREMENT NOT NULL, qcm_question_id INT DEFAULT NULL, value VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_right_answer TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_2282D82BEA58905F (qcm_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE response_selected_by_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, qcm_id INT DEFAULT NULL, qcm_question_id INT DEFAULT NULL, qcm_response_choice_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_73F5D384180EC108 (qcm_response_choice_id), INDEX IDX_73F5D384FF6241A6 (qcm_id), INDEX IDX_73F5D384EA58905F (qcm_question_id), INDEX IDX_73F5D384A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE study (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, chapter_id INT DEFAULT NULL, note LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, is_finish TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_E67F9749579F4768 (chapter_id), INDEX IDX_E67F9749A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE assit_appointment ADD CONSTRAINT FK_5FB53060A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE assit_appointment ADD CONSTRAINT FK_5FB53060E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52ECDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0F33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE order_invoice ADD CONSTRAINT FK_661FBE0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_invoice_line ADD CONSTRAINT FK_D71142F99A530CA8 FOREIGN KEY (order_invoice_id) REFERENCES order_invoice (id)');
        $this->addSql('ALTER TABLE order_invoice_line ADD CONSTRAINT FK_D71142F9A21126A1 FOREIGN KEY (command_line_id) REFERENCES command_line (id)');
        $this->addSql('ALTER TABLE qcm ADD CONSTRAINT FK_D7A1FEF4CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE qcm_question ADD CONSTRAINT FK_572B6C8DFF6241A6 FOREIGN KEY (qcm_id) REFERENCES qcm (id)');
        $this->addSql('ALTER TABLE qcm_response_choice ADD CONSTRAINT FK_2282D82BEA58905F FOREIGN KEY (qcm_question_id) REFERENCES qcm_question (id)');
        $this->addSql('ALTER TABLE response_selected_by_user ADD CONSTRAINT FK_73F5D384180EC108 FOREIGN KEY (qcm_response_choice_id) REFERENCES qcm_response_choice (id)');
        $this->addSql('ALTER TABLE response_selected_by_user ADD CONSTRAINT FK_73F5D384EA58905F FOREIGN KEY (qcm_question_id) REFERENCES qcm_question (id)');
        $this->addSql('ALTER TABLE response_selected_by_user ADD CONSTRAINT FK_73F5D384A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response_selected_by_user ADD CONSTRAINT FK_73F5D384FF6241A6 FOREIGN KEY (qcm_id) REFERENCES qcm (id)');
        $this->addSql('ALTER TABLE study ADD CONSTRAINT FK_E67F9749579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('ALTER TABLE study ADD CONSTRAINT FK_E67F9749A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD user_type_id INT DEFAULT NULL, ADD username VARCHAR(50) NOT NULL, ADD last_name VARCHAR(50) DEFAULT NULL, ADD first_name VARCHAR(50) DEFAULT NULL, ADD phone VARCHAR(40) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD is_verified TINYINT(1) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499D419299 FOREIGN KEY (user_type_id) REFERENCES user_type (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499D419299 ON user (user_type_id)');
    }
}
