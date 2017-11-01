<?php

namespace SinglehopLlc\Base\Infrastructure\Repository\EventStore;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use SinglehopLlc\Base\Domain\Model\Example\Example;
use SinglehopLlc\Base\Domain\Model\Example\ExampleCollection;
use SinglehopLlc\Base\Domain\Model\Example\ExampleId;

/**
 * Class EventStoreExampleCollection
 * @package SinglehopLlc\Base\Infrastructure\Repository\EventStore
 */
final class EventStoreExampleCollection extends AggregateRepository implements ExampleCollection
{

    /**
     * @param Example $example
     * @return void
     */
    public function add(Example $example)
    {
        $this->saveAggregateRoot($example);
    }

    /**
     * @param ExampleId $exampleId
     * @return Example
     */
    public function get(ExampleId $exampleId)
    {
        /** @var Example $object */
        $object = $this->getAggregateRoot($exampleId);
        return $object;
    }
}
