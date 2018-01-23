<?php

declare(strict_types=1);

namespace CodelyTv\Infrastructure\Doctrine;

use CodelyTv\Types\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class Repository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function entityManager(): EntityManager
    {
        return $this->entityManager;
    }

    protected function persist(AggregateRoot $entity): void
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove(AggregateRoot $entity): void
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function persister(): callable
    {
        return function (AggregateRoot $entity): void {
            $this->persist($entity);
        };
    }

    protected function remover(): callable
    {
        return function (AggregateRoot $entity): void {
            $this->remove($entity);
        };
    }

    protected function repository($entityClass): EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    protected function queryBuilder(): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder();
    }
}
