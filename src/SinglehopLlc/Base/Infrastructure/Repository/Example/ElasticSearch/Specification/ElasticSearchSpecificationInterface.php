<?php

namespace SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch\Specification;

/**
 * Interface ElasticSearchSpecificationInterface
 * @package SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch\Specification
 */
interface ElasticSearchSpecificationInterface
{
    public function toElasticSearchClauses();
}
