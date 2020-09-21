<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Shared\Infraestructure\PhpUnit;

use CodelyTv\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use CodelyTv\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use CodelyTv\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use CodelyTv\Tests\Shared\Infrastructure\Elastic\ElasticDatabaseCleaner;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class BackofficeEnvironmentArranger implements EnvironmentArranger
{
    private ElasticsearchClient $elasticsearchClient;
    private EntityManager       $entityManager;

    public function __construct(ElasticsearchClient $elasticsearchClient, EntityManager $entityManager)
    {
        $this->elasticsearchClient = $elasticsearchClient;
        $this->entityManager       = $entityManager;
    }

    public function arrange(): void
    {
        apply(new ElasticDatabaseCleaner(), [$this->elasticsearchClient]);
        apply(new MySqlDatabaseCleaner(), [$this->entityManager]);
    }

    public function close(): void
    {
    }
}
