<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226190141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (app_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(app_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devices (uid INT NOT NULL, app_id INT NOT NULL, language INT NOT NULL, operating_system INT NOT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(uid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, device_uid INT NOT NULL, app_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, expired_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, status INT NOT NULL, INDEX IDX_E52FFDEEB965DC9F (device_uid), INDEX IDX_E52FFDEE7987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB965DC9F FOREIGN KEY (device_uid) REFERENCES devices (uid)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE7987212D FOREIGN KEY (app_id) REFERENCES applications (app_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE7987212D');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB965DC9F');
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE devices');
        $this->addSql('DROP TABLE orders');
    }
}
