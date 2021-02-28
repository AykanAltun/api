<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228200202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applications (app_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(app_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devices (uid INT NOT NULL, app_id INT NOT NULL, language INT NOT NULL, operating_system INT NOT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(uid, app_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, uid INT NOT NULL, app_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, expired_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, status INT NOT NULL, INDEX search_idx (uid, app_id, status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE devices');
        $this->addSql('DROP TABLE orders');
    }
}
