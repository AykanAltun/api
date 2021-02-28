<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227063011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE7987212D');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEB965DC9F');
        $this->addSql('DROP INDEX IDX_E52FFDEE7987212D ON orders');
        $this->addSql('DROP INDEX IDX_E52FFDEEB965DC9F ON orders');
        $this->addSql('ALTER TABLE orders CHANGE device_uid uid INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders CHANGE uid device_uid INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE7987212D FOREIGN KEY (app_id) REFERENCES applications (app_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEB965DC9F FOREIGN KEY (device_uid) REFERENCES devices (uid) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E52FFDEE7987212D ON orders (app_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEB965DC9F ON orders (device_uid)');
    }
}
