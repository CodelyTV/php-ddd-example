<?php

namespace CodelyTv\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use CodelyTv\Types\Aggregate\AggregateRoot;

abstract class Repository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function entityManager() : EntityManager
    {
        return $this->entityManager;
    }

    protected function persist(AggregateRoot $entity)
    {
        $this->entityManager()->persist($entity);
        $this->entityManager()->flush($entity);
    }

    protected function remove(AggregateRoot $entity)
    {
        $this->entityManager()->remove($entity);
        $this->entityManager()->flush($entity);
    }

    protected function persister()
    {
        return function (AggregateRoot $entity) {
            $this->persist($entity);
        };
    }

    protected function remover()
    {
        return function (AggregateRoot $entity) {
            $this->remove($entity);
        };
    }

    protected function repository($entityClass) : EntityRepository
    {
        return $this->entityManager->getRepository($entityClass);
    }

    protected function queryBuilder()
    {
        return $this->entityManager->createQueryBuilder();
    }
}
