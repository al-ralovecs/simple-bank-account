<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231004151505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id UUID NOT NULL, user_id UUID NOT NULL, currency VARCHAR(3) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX account_by_user_idx ON account (user_id)');
        $this->addSql('COMMENT ON COLUMN account.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN account.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN account.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE client (id UUID NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN client.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE exchange_rate (base_currency VARCHAR(3) NOT NULL, counter_currency VARCHAR(3) NOT NULL, ratio VARCHAR(32) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(base_currency, counter_currency))');
        $this->addSql('COMMENT ON COLUMN exchange_rate.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE transaction (id UUID NOT NULL, account_id UUID NOT NULL, amount INT NOT NULL, currency VARCHAR(3) NOT NULL, source_account_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX transaction_by_account_idx ON transaction (account_id)');
        $this->addSql('COMMENT ON COLUMN transaction.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN transaction.account_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN transaction.source_account_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN transaction.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4A76ED395 FOREIGN KEY (user_id) REFERENCES client (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D19B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A4A76ED395');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D19B6B5FBA');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE exchange_rate');
        $this->addSql('DROP TABLE transaction');
    }
}
