<?php

namespace SinglehopLlc\Base\Domain\Model\Example;

/**
 * Interface ExampleCollection
 * @package SinglehopLlc\Base\Domain\Model\Example
 */
interface ExampleCollection
{
    /**
     * @param Example $example
     * @return void
     */
    public function add(Example $example);

    /**
     * @param ExampleId $exampleId
     * @return Example
     */
    public function get(ExampleId $exampleId);
}
