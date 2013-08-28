<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130828111643 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE user ADD role_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE user ADD CONSTRAINT FK_2DA17977D60322AC FOREIGN KEY (role_id) REFERENCES Role (id)");
        $this->addSql("CREATE INDEX IDX_2DA17977D60322AC ON user (role_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE User DROP FOREIGN KEY FK_2DA17977D60322AC");
        $this->addSql("DROP INDEX IDX_2DA17977D60322AC ON User");
        $this->addSql("ALTER TABLE User DROP role_id");
    }
}
