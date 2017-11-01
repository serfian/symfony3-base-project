<?php

namespace SinglehopLlc\Base\Domain\Model\Example\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use SinglehopLlc\Base\Domain\Model\Example\ExampleId;

/**
 * Class CreateExampleCommand
 * @package SinglehopLlc\Base\Domain\Model\Example\Command
 */
class CreateExampleCommand extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function withData(ExampleId $exampleId): CreateExampleCommand
    {
        return new self([
            'exampleId' => $exampleId->toString()
        ]);
    }

    public function exampleId(): ExampleId
    {
        return ExampleId::fromString($this->payload['exampleId']);
    }
}
