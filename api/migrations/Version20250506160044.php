<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506160044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE request (id SERIAL NOT NULL, car_id_id INT NOT NULL, program_id_id INT NOT NULL, initial_payment INT NOT NULL, loan_term INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3B978F9FA0EF1B80 ON request (car_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3B978F9FE12DEDA1 ON request (program_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request ADD CONSTRAINT FK_3B978F9FA0EF1B80 FOREIGN KEY (car_id_id) REFERENCES property (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request ADD CONSTRAINT FK_3B978F9FE12DEDA1 FOREIGN KEY (program_id_id) REFERENCES calc_startegy (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request DROP CONSTRAINT FK_3B978F9FA0EF1B80
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE request DROP CONSTRAINT FK_3B978F9FE12DEDA1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE request
        SQL);
    }
}
