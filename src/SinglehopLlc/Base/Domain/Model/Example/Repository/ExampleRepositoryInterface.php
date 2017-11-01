<?php

namespace SinglehopLlc\Base\Domain\Model\Example\Repository;

use SinglehopLlc\Base\Domain\Model\Example\Example;
use SinglehopLlc\Base\Domain\Model\Example\ExampleId;

/**
 * Interface ExampleRepositoryInterface
 * @package SinglehopLlc\Base\Domain\Model\Example\Repository
 */
interface ExampleRepositoryInterface
{
    public function save(Example $example);
    public function ofId(ExampleId $exampleId);
    public function query($specification);
    public function queryOne($specification);
}
