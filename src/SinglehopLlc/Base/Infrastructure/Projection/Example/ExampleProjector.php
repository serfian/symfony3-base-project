<?php

namespace SinglehopLlc\Base\Infrastructure\Projection\Example;

use SinglehopLlc\Base\Domain\Model\Example\Event\ExampleWasCreated;
use SinglehopLlc\Base\Domain\Model\Example\Repository\ExampleRepositoryInterface;
use SinglehopLlc\Base\Domain\Model\Example\ExampleCollection;

/**
 * Class ExampleProjector
 * @package SinglehopLlc\Base\Infrastructure\Projection\Example
 */
final class ExampleProjector
{
    private $repository;
    private $eventStoreCollection;

    public function __construct(ExampleRepositoryInterface $repository, ExampleCollection $collection)
    {
        $this->repository = $repository;
        $this->eventStoreCollection = $collection;
    }

    public function __invoke(ExampleWasCreated $event)
    {
        $example = $this->eventStoreCollection->get($event->exampleId());
        $this->repository->save($example);
    }
}
