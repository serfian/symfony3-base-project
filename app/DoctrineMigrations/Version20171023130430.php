<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171023130430 extends AbstractMigration implements ContainerAwareInterface
{
    /** @var  ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );
        $schema = $this->container->getParameter('database.schema');
        $this->addSql("CREATE TABLE $schema.event_streams (
                                  no BIGSERIAL,
                                  real_stream_name VARCHAR(150) NOT NULL,
                                  stream_name CHAR(52) NOT NULL,
                                  metadata JSONB,
                                  category VARCHAR(150),
                                  PRIMARY KEY (no),
                                  UNIQUE (stream_name)
                          );");
        $this->addSql("CREATE INDEX on $schema.event_streams (category);");
        $this->addSql("CREATE TABLE $schema.projections (
                                  no BIGSERIAL,
                                  name VARCHAR(150) NOT NULL,
                                  position JSONB,
                                  state JSONB,
                                  status VARCHAR(28) NOT NULL,
                                  locked_until CHAR(26),
                                  PRIMARY KEY (no),
                                  UNIQUE (name)
                            );");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema = $this->container->getParameter('database.schema');
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );
        $this->addSql("DROP TABLE $schema.event_streams");
        $this->addSql("DROP TABLE $schema.projections");
    }
}
