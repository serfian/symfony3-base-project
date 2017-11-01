<?php

namespace SinglehopLlc\Base\Domain\Model\Example\Handler;

use Prooph\EventSourcing\Aggregate\AggregateRepository;
use SinglehopLlc\Base\Domain\Model\Example\Command\CreateExampleCommand;
use SinglehopLlc\Base\Domain\Model\Example\Example;
use SinglehopLlc\Base\Domain\Model\Example\ExampleCollection;

/**
 * Class CreateExampleHandler
 * @package SinglehopLlc\Base\Domain\Model\Example\Handler
 */
final class CreateExampleHandler
{
    /** @var  ExampleCollection */
    private $exampleCollection;

    public function __construct(AggregateRepository $exampleCollection)
    {
        $this->exampleCollection = $exampleCollection;
    }

    public function __invoke(CreateExampleCommand $command)
    {
        $example = Example::create(
            $command->exampleId()
        );

        $this->exampleCollection->add($example);
    }
}
