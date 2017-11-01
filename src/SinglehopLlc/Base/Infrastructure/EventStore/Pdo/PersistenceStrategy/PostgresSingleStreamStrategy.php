<?php

namespace SinglehopLlc\Base\Infrastructure\EventStore\Pdo\PersistenceStrategy;

use Assert\Assertion;
use Iterator;
use Prooph\EventStore\Pdo\PersistenceStrategy;
use Prooph\EventStore\StreamName;

/**
 * Class PostgresSingleStreamStrategy
 * @package SinglehopLlc\Base\Infrastructure\EventStore\Pdo\PersistenceStrategy
 */
final class PostgresSingleStreamStrategy implements PersistenceStrategy
{
    private $schema;

    public function __construct($schema)
    {
        Assertion::lessOrEqualThan($schema, 10, 'schema name should be less than 11 characters');
        $this->schema = $schema;
    }

    /**
     * @param string $tableName
     * @return string[]
     */
    public function createSchema(string $tableName): array
    {
        $statement = <<<EOT
        CREATE TABLE $tableName (
            no BIGSERIAL,
            event_id CHAR(36) NOT NULL,
            event_name VARCHAR(100) NOT NULL,
            payload JSON NOT NULL,
            metadata JSONB NOT NULL,
            created_at TIMESTAMP(6) NOT NULL,
            PRIMARY KEY (no),
            CONSTRAINT aggregate_version_not_null CHECK ((metadata->>'_aggregate_version') IS NOT NULL),
            CONSTRAINT aggregate_type_not_null CHECK ((metadata->>'_aggregate_type') IS NOT NULL),
            CONSTRAINT aggregate_id_not_null CHECK ((metadata->>'_aggregate_id') IS NOT NULL),
            UNIQUE (event_id)
        );
EOT;

        $index1 = <<<EOT
        CREATE UNIQUE INDEX ON $tableName
            ((metadata->>'_aggregate_type'), (metadata->>'_aggregate_id'), (metadata->>'_aggregate_version'));
EOT;

        $index2 = <<<EOT
        CREATE INDEX ON $tableName
            ((metadata->>'_aggregate_type'), (metadata->>'_aggregate_id'), no);
EOT;

        return [
            $statement,
            $index1,
            $index2,
        ];
    }

    public function columnNames(): array
    {
        return [
            'event_id',
            'event_name',
            'payload',
            'metadata',
            'created_at',
        ];
    }

    public function prepareData(Iterator $streamEvents): array
    {
        $data = [];

        foreach ($streamEvents as $event) {
            $data[] = $event->uuid()->toString();
            $data[] = $event->messageName();
            $data[] = json_encode($event->payload());
            $data[] = json_encode($event->metadata());
            $data[] = $event->createdAt()->format('Y-m-d\TH:i:s.u');
        }

        return $data;
    }

    public function generateTableName(StreamName $streamName): string
    {
        return $this->schema.'._' . sha1($streamName->toString());
    }
}
