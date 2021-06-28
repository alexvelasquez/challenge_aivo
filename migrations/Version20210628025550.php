<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628025550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create authenticator user';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $now = (new \DateTime())->format('Y-m-d H:m:s');
        $this->addSql( "INSERT INTO user (username, password, created_at, updated_at) VALUES ('ws_aivo', 'tkWgUrVTNzMhXyJeeAiebfI2+xKmgLXsLHnE0SRZIs7mpubaQXMRo0P49dVzdv8ZHRG6cl8VNMQ8h1P1U5zAhQ==', '{$now}', '{$now}')");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
