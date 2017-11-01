<?php

namespace SinglehopLlc\Base\Domain\Model\Example\Event;

use Prooph\EventSourcing\AggregateChanged;
use SinglehopLlc\Base\Domain\Model\Example\ExampleId;

/**
 * Class ExampleWasCreated
 * @package SinglehopLlc\Base\Domain\Model\Example\Event
 */
class ExampleWasCreated extends AggregateChanged
{
    /** @var  ExampleId */
    private $exampleId;

    public static function withData(
        ExampleId $exampleId
    ): AggregateChanged {
        $event = self::occur(
            $exampleId->toString(),
            [
                'exampleId'=>$exampleId->toString()
            ]
        );
        return $event;
    }

    public function exampleId(): ExampleId
    {
        if ($this->exampleId === null) {
            $this->exampleId = ExampleId::fromString($this->payload['exampleId']);
        }
        return $this->exampleId;
    }
}
