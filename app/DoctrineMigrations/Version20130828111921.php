<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130828111921 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Campaign (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E663708BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Counter (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, count INT NOT NULL, timestamp DATETIME NOT NULL, INDEX IDX_E9FADE4F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_2DA17977D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE Campaign ADD CONSTRAINT FK_E663708BA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)");
        $this->addSql("ALTER TABLE Counter ADD CONSTRAINT FK_E9FADE4F639F774 FOREIGN KEY (campaign_id) REFERENCES Campaign (id)");
        $this->addSql("ALTER TABLE User ADD CONSTRAINT FK_2DA17977D60322AC FOREIGN KEY (role_id) REFERENCES Role (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Counter DROP FOREIGN KEY FK_E9FADE4F639F774");
        $this->addSql("ALTER TABLE User DROP FOREIGN KEY FK_2DA17977D60322AC");
        $this->addSql("ALTER TABLE Campaign DROP FOREIGN KEY FK_E663708BA76ED395");
        $this->addSql("DROP TABLE Campaign");
        $this->addSql("DROP TABLE Counter");
        $this->addSql("DROP TABLE Role");
        $this->addSql("DROP TABLE User");
    }
}
