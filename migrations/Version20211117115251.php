<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117115251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, fecha_nacimiento VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, nacionalidad VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, biografia VARCHAR(4096) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, imagen VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pelicula (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(128) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, duracion INT DEFAULT NULL, director VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, genero VARCHAR(128) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, imagen VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, sinopsis VARCHAR(4096) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, estreno INT NOT NULL, valoracion INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, roles LONGTEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, displayname VARCHAR(32) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, username VARCHAR(32) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, phone VARCHAR(16) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX username (username), UNIQUE INDEX phone (phone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE actor');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pelicula');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
