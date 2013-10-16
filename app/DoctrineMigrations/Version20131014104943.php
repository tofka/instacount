<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131014104943 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Campaign (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, name VARCHAR(255) NOT NULL, tag VARCHAR(255) NOT NULL, positions LONGTEXT DEFAULT NULL, facebook_url LONGTEXT DEFAULT NULL, INDEX IDX_E663708BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Counter (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, count INT NOT NULL, timestamp DATETIME NOT NULL, INDEX IDX_E9FADE4F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE acme_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, salt VARCHAR(32) NOT NULL, password VARCHAR(40) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_55884A7F85E0677 (username), UNIQUE INDEX UNIQ_55884A7E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Campaign ADD CONSTRAINT FK_E663708BA76ED395 FOREIGN KEY (user_id) REFERENCES acme_users (id)");
        $this->addSql("ALTER TABLE Counter ADD CONSTRAINT FK_E9FADE4F639F774 FOREIGN KEY (campaign_id) REFERENCES Campaign (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Counter DROP FOREIGN KEY FK_E9FADE4F639F774");
        $this->addSql("ALTER TABLE Campaign DROP FOREIGN KEY FK_E663708BA76ED395");
        $this->addSql("DROP TABLE Campaign");
        $this->addSql("DROP TABLE Counter");
        $this->addSql("DROP TABLE Role");
        $this->addSql("DROP TABLE acme_users");
    }
}
