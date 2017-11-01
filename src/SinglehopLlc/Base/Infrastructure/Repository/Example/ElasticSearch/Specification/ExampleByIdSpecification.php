<?php

namespace SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch\Specification;

use Elastica\Query;

/**
 * Class ExampleByIdSpecification
 * @package SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch\Specification
 */
class ExampleByIdSpecification implements ElasticSearchSpecificationInterface
{
    private $exampleIds;

    public function __construct(array $exampleIds)
    {
        $this->exampleIds = $exampleIds;
    }

    public function toElasticSearchClauses()
    {
        $query = new Query();
        if (!empty($this->exampleIds)) {
            $boolQuery = (new Query\BoolQuery())
                ->addFilter((new Query\Terms())->setTerms('exampleId', $this->exampleIds));
            $query->setQuery($boolQuery);
            return $query;
        }

        return [];
    }
}
