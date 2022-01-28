<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128162431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_program ADD program_type_id INT NOT NULL, ADD room_id INT NOT NULL');
        $this->addSql('ALTER TABLE training_program ADD CONSTRAINT FK_4FD3E78A4EA67447 FOREIGN KEY (program_type_id) REFERENCES program_type (id)');
        $this->addSql('ALTER TABLE training_program ADD CONSTRAINT FK_4FD3E78A54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_4FD3E78A4EA67447 ON training_program (program_type_id)');
        $this->addSql('CREATE INDEX IDX_4FD3E78A54177093 ON training_program (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_program DROP FOREIGN KEY FK_4FD3E78A4EA67447');
        $this->addSql('ALTER TABLE training_program DROP FOREIGN KEY FK_4FD3E78A54177093');
        $this->addSql('DROP INDEX IDX_4FD3E78A4EA67447 ON training_program');
        $this->addSql('DROP INDEX IDX_4FD3E78A54177093 ON training_program');
        $this->addSql('ALTER TABLE training_program DROP program_type_id, DROP room_id');
    }
}
