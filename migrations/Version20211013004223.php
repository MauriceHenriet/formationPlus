<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211013004223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attestation DROP FOREIGN KEY FK_326EC63FA2ACEBCC');
        $this->addSql('ALTER TABLE attestation DROP FOREIGN KEY FK_326EC63FDDEAB1A3');
        $this->addSql('DROP INDEX UNIQ_326EC63FA2ACEBCC ON attestation');
        $this->addSql('DROP INDEX UNIQ_326EC63FDDEAB1A3 ON attestation');
        $this->addSql('ALTER TABLE attestation DROP etudiant_id, DROP convention_id');
        $this->addSql('ALTER TABLE convention ADD attestation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657E7EDC5B38 FOREIGN KEY (attestation_id) REFERENCES attestation (id)');
        $this->addSql('CREATE INDEX IDX_8556657E7EDC5B38 ON convention (attestation_id)');
        $this->addSql('ALTER TABLE etudiant ADD attestation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E37EDC5B38 FOREIGN KEY (attestation_id) REFERENCES attestation (id)');
        $this->addSql('CREATE INDEX IDX_717E22E37EDC5B38 ON etudiant (attestation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attestation ADD etudiant_id INT DEFAULT NULL, ADD convention_id INT NOT NULL');
        $this->addSql('ALTER TABLE attestation ADD CONSTRAINT FK_326EC63FA2ACEBCC FOREIGN KEY (convention_id) REFERENCES convention (id)');
        $this->addSql('ALTER TABLE attestation ADD CONSTRAINT FK_326EC63FDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_326EC63FA2ACEBCC ON attestation (convention_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_326EC63FDDEAB1A3 ON attestation (etudiant_id)');
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657E7EDC5B38');
        $this->addSql('DROP INDEX IDX_8556657E7EDC5B38 ON convention');
        $this->addSql('ALTER TABLE convention DROP attestation_id');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E37EDC5B38');
        $this->addSql('DROP INDEX IDX_717E22E37EDC5B38 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP attestation_id');
    }
}
