<?php

namespace SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch;

use FOS\ElasticaBundle\Finder\TransformedFinder;
use FOS\ElasticaBundle\Persister\ObjectSerializerPersister;
use SinglehopLlc\Base\Domain\Model\Example\Repository\ExampleRepositoryInterface;
use SinglehopLlc\Base\Domain\Model\Example\Example;
use SinglehopLlc\Base\Domain\Model\Example\ExampleId;
use SinglehopLlc\Base\Infrastructure\Repository\Example\ElasticSearch\Specification\ExampleByIdSpecification;

/**
 * Class ElasticSearchExampleRepository
 * @package SinglehopLlc\Base\Infrastructure\Repository\ElasticSearch
 */
class ElasticSearchExampleRepository implements ExampleRepositoryInterface
{
    private $persister;
    private $finder;

    public function __construct(ObjectSerializerPersister $persister, TransformedFinder $finder)
    {
        $this->persister = $persister;
        $this->finder = $finder;
    }

    public function save(Example $example)
    {
        $this->persister->replaceOne($example);
    }

    public function ofId(ExampleId $exampleId)
    {
        $result = (new ExampleByIdSpecification([$exampleId->toString()]))->toElasticSearchClauses();
        return array_pop($result);
    }

    public function query($specification)
    {
        return $this->finder->find($specification->toElasticSearchClauses());
    }

    public function queryOne($specification)
    {
        $result = $this->query($specification);
        return array_pop($result);
    }
}
