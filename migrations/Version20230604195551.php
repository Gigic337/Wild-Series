<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230604195551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actor_program (actor_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_B01827EE10DAF24A (actor_id), INDEX IDX_B01827EE3EB8070A (program_id), PRIMARY KEY(actor_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_program ADD CONSTRAINT FK_B01827EE10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_program ADD CONSTRAINT FK_B01827EE3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT NOT NULL, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE synopsis synopsis LONGTEXT NOT NULL, CHANGE poster poster VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE year year INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED77842B36786B ON program (title)');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA912469DE2');
        $this->addSql('DROP INDEX IDX_F0E45BA912469DE2 ON season');
        $this->addSql('ALTER TABLE season DROP category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_program DROP FOREIGN KEY FK_B01827EE10DAF24A');
        $this->addSql('ALTER TABLE actor_program DROP FOREIGN KEY FK_B01827EE3EB8070A');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE actor_program');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE episode CHANGE season_id season_id INT DEFAULT NULL, CHANGE synopsis synopsis VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_92ED77842B36786B ON program');
        $this->addSql('ALTER TABLE program CHANGE synopsis synopsis VARCHAR(255) NOT NULL, CHANGE poster poster VARCHAR(255) NOT NULL, CHANGE country country VARCHAR(255) NOT NULL, CHANGE year year INT NOT NULL');
        $this->addSql('ALTER TABLE season ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA912469DE2 FOREIGN KEY (category_id) REFERENCES program (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F0E45BA912469DE2 ON season (category_id)');
    }
}
