<?php

declare(strict_types=1);

namespace App\Cards\Infrastructure\Persistence\Doctrine\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240318000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create cards table with value objects';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE cards (
            id INT AUTO_INCREMENT NOT NULL,
            
            -- Basic fields
            name VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            custom_description TEXT DEFAULT NULL,
            
            -- Bank Value Object
            bank_id VARCHAR(255) NOT NULL,
            bank_name VARCHAR(255) NOT NULL,
            bank_logo VARCHAR(255) NOT NULL,
            
            -- CardType Value Object
            card_type VARCHAR(50) NOT NULL,
            card_type_display VARCHAR(255) NOT NULL,
            
            -- Money Value Objects
            first_year_fee_amount DECIMAL(10,2) NOT NULL,
            first_year_fee_currency VARCHAR(3) NOT NULL,
            
            tae DECIMAL(10,2) NOT NULL,
            
            -- Arrays
            benefits JSON NOT NULL,
            insurances JSON NOT NULL,
            services JSON NOT NULL,
            
            -- ContentHash Value Object
            content_hash VARCHAR(32) NOT NULL,
            
            -- Timestamps
            created_at DATETIME NOT NULL,
            updated_at DATETIME DEFAULT NULL,
            
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE INDEX idx_cards_bank ON cards (bank_id)');
        $this->addSql('CREATE INDEX idx_cards_content ON cards (content_hash)');
        $this->addSql('CREATE INDEX idx_cards_type ON cards (card_type)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS cards');
    }
} 