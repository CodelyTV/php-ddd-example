<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Persistence\Elasticsearch;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use function Lambdish\Phunctional\get_in;
use function Lambdish\Phunctional\map;

abstract class ElasticsearchRepository
{
    private $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    abstract protected function aggregateName(): string;

    protected function persist(string $id, array $plainBody): void
    {
        $this->client->persist($this->aggregateName(), $id, $plainBody);
    }

    protected function searchAllInElastic(): array
    {
        return $this->searchRawElasticsearchQuery([]);
    }

    protected function searchRawElasticsearchQuery(array $params): array
    {
        try {
            $result = $this->client->client()->search(array_merge(['index' => $this->indexName()], $params));

            $hits = get_in(['hits', 'hits'], $result, []);

            return map($this->elasticValuesExtractor(), $hits);
        } catch (Missing404Exception $unused) {
            return [];
        }
    }

    public function searchByCriteria(Criteria $criteria): array
    {
        $converter = new ElasticsearchCriteriaConverter();

        $query = $converter->convert($criteria);

        return $this->searchRawElasticsearchQuery($query);
    }

    protected function indexName(): string
    {
        return sprintf('%s_%s', $this->client->indexPrefix(), $this->aggregateName());
    }

    private function elasticValuesExtractor(): callable
    {
        return static function (array $elasticValues): array {
            return $elasticValues['_source'];
        };
    }
}
