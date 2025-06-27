<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250626135936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE company (id SERIAL NOT NULL, company_name VARCHAR(255) NOT NULL, trade_name VARCHAR(255) NOT NULL, cnpj VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN company.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN company.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE partner (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN partner.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN partner.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE partner_company (partner_id INT NOT NULL, company_id INT NOT NULL, PRIMARY KEY(partner_id, company_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_88556A529393F8FE ON partner_company (partner_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_88556A52979B1AD6 ON partner_company (company_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partner_company ADD CONSTRAINT FK_88556A529393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partner_company ADD CONSTRAINT FK_88556A52979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partner_company DROP CONSTRAINT FK_88556A529393F8FE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partner_company DROP CONSTRAINT FK_88556A52979B1AD6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE company
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE partner
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE partner_company
        SQL);
    }
}
