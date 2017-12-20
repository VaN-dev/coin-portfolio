<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171220092638 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ticker (id INT AUTO_INCREMENT NOT NULL, coin_id INT DEFAULT NULL, fiat_id INT DEFAULT NULL, created_at DATETIME NOT NULL, value NUMERIC(20, 10) NOT NULL, INDEX IDX_7EC3089684BBDA7 (coin_id), INDEX IDX_7EC3089683FE8D27 (fiat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, symbol VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticker ADD CONSTRAINT FK_7EC3089684BBDA7 FOREIGN KEY (coin_id) REFERENCES coin (id)');
        $this->addSql('ALTER TABLE ticker ADD CONSTRAINT FK_7EC3089683FE8D27 FOREIGN KEY (fiat_id) REFERENCES fiat (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticker DROP FOREIGN KEY FK_7EC3089683FE8D27');
        $this->addSql('DROP TABLE ticker');
        $this->addSql('DROP TABLE fiat');
    }
}
