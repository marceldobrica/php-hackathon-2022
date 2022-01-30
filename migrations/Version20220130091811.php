<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130091811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bookings (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, cnp VARCHAR(13) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_7A853C353EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, program_type_id INT NOT NULL, room_id INT NOT NULL, name VARCHAR(100) NOT NULL, start_date_time DATETIME NOT NULL, end_date_time DATETIME NOT NULL, numar_maxim_participanti INT NOT NULL, participants INT NOT NULL, INDEX IDX_92ED77844EA67447 (program_type_id), INDEX IDX_92ED778454177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, max_persons_in_room INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_program_type (room_id INT NOT NULL, program_type_id INT NOT NULL, INDEX IDX_374A1ABD54177093 (room_id), INDEX IDX_374A1ABD4EA67447 (program_type_id), PRIMARY KEY(room_id, program_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bookings ADD CONSTRAINT FK_7A853C353EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED77844EA67447 FOREIGN KEY (program_type_id) REFERENCES program_type (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED778454177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room_program_type ADD CONSTRAINT FK_374A1ABD54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_program_type ADD CONSTRAINT FK_374A1ABD4EA67447 FOREIGN KEY (program_type_id) REFERENCES program_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookings DROP FOREIGN KEY FK_7A853C353EB8070A');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED77844EA67447');
        $this->addSql('ALTER TABLE room_program_type DROP FOREIGN KEY FK_374A1ABD4EA67447');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED778454177093');
        $this->addSql('ALTER TABLE room_program_type DROP FOREIGN KEY FK_374A1ABD54177093');
        $this->addSql('DROP TABLE bookings');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_type');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_program_type');
    }
}
