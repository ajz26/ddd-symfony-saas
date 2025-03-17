<?php

declare(strict_types=1);

namespace App\Cards\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311215128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table cards with all fields';
    }

    public function up(Schema $schema): void
    {
        // create table cards con todos los campos
        $this->addSql('CREATE TABLE cards (
            id INT AUTO_INCREMENT NOT NULL,
            link VARCHAR(255) NOT NULL, # required
            logo VARCHAR(255) NOT NULL, # required
            test_seal VARCHAR(255) DEFAULT NULL, # not required
            test_seal_url VARCHAR(255) DEFAULT NULL, # not required
            bank_id INT NOT NULL, # required
            product_id INT NOT NULL, # required
            description TEXT NOT NULL, # required
            custom_description TEXT DEFAULT NULL, # not required
            bank VARCHAR(255) NOT NULL, # required
            product VARCHAR(255) NOT NULL,
            custom_product_name VARCHAR(255) DEFAULT NULL,
            rating DECIMAL(2,1) DEFAULT NULL CHECK (rating >= 1 AND rating <= 5),
            evaluation_number TINYINT(1) DEFAULT 0,
            incentive DECIMAL(10,2) DEFAULT NULL,
            fees DOUBLE PRECISION DEFAULT NULL,
            cost DOUBLE PRECISION DEFAULT NULL,
            bonusprogram TINYINT(1) DEFAULT 0,
            insurance TINYINT(1) DEFAULT 0,
            benefits TINYINT(1) DEFAULT 0,
            services TINYINT(1) DEFAULT 0,
            special_features JSON DEFAULT NULL,
            fees_action VARCHAR(255) DEFAULT NULL,
            cost_action VARCHAR(255) DEFAULT NULL,
            custom_cost_action VARCHAR(255) DEFAULT NULL,
            fees_first_year DOUBLE PRECISION NOT NULL,
            fees_after_first_year DOUBLE PRECISION NOT NULL,
            gc_atmfree_domestic DOUBLE PRECISION NOT NULL,
            gc_atmfree_international DOUBLE PRECISION NOT NULL,
            cc_atmfree_domestic DOUBLE PRECISION NOT NULL,
            cc_atmfree_international DOUBLE PRECISION NOT NULL,
            incentive_amount DOUBLE PRECISION NOT NULL,
            interest_rate DOUBLE PRECISION NOT NULL,
            shall_interest_rate DOUBLE PRECISION NOT NULL,
            cardtype TINYINT NOT NULL DEFAULT 0,
            cardtype_text VARCHAR(10) NOT NULL,
            cc_atmfree_euro DOUBLE PRECISION NOT NULL,
            kkoffer TINYINT(1) NOT NULL,
            content_crc VARCHAR(255) NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE cards');
    }
}
