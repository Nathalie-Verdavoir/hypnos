<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316143842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambres ADD hotel_id INT NOT NULL, ADD prix NUMERIC(10, 2) NOT NULL, ADD booking VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chambres ADD CONSTRAINT FK_36C929623243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_36C929623243BB18 ON chambres (hotel_id)');
        $this->addSql('ALTER TABLE photo ADD chambres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188BEC3FB7 FOREIGN KEY (chambres_id) REFERENCES chambres (id)');
        $this->addSql('CREATE INDEX IDX_14B784188BEC3FB7 ON photo (chambres_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambres DROP FOREIGN KEY FK_36C929623243BB18');
        $this->addSql('DROP INDEX IDX_36C929623243BB18 ON chambres');
        $this->addSql('ALTER TABLE chambres DROP hotel_id, DROP prix, DROP booking');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188BEC3FB7');
        $this->addSql('DROP INDEX IDX_14B784188BEC3FB7 ON photo');
        $this->addSql('ALTER TABLE photo DROP chambres_id');
    }
}
