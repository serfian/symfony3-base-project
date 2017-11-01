<?php

namespace SinglehopLlc\Base\Domain\Model\Example;

use Assert\Assertion;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use SinglehopLlc\Base\Domain\Model\Example\Event\ExampleWasCreated;

/**
 * Class Example
 * @package SinglehopLlc\Base\Domain\Model\Example
 */
class Example extends AggregateRoot
{
    /** @var  ExampleId */
    private $exampleId;

    protected function aggregateId(): string
    {
        return $this->exampleId->toString();
    }

    public static function create(ExampleId $exampleId): Example
    {
        $self = new self();
        $self->recordThat(ExampleWasCreated::withData(
            $exampleId
        ));
        return $self;
    }

    public static function fromArray(array $object)
    {
        Assertion::keyExists($object, 'exampleId');
        return self::create(
            ExampleId::fromString($object['exampleId'])
        );
    }

    protected function apply(AggregateChanged $event): void
    {
        $handler = $this->determineEventHandlerMethodFor($event);
        if (!method_exists($this, $handler)) {
            throw new \RuntimeException(sprintf(
                'Missing event handler method %s for aggregate root %s',
                $handler,
                get_class($this)
            ));
        }
        $this->{$handler}($event);
    }

    protected function whenExampleWasCreated(ExampleWasCreated $event)
    {
        $this->exampleId = $event->exampleId();
    }

    protected function determineEventHandlerMethodFor(AggregateChanged $e): string
    {
        return 'when' . implode(array_slice(explode('\\', get_class($e)), -1));
    }
}
