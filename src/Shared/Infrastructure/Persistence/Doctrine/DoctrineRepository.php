<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Persistence\Doctrine;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Exception\NotSupported;

abstract class DoctrineRepository
{
	public function __construct(private readonly EntityManager $entityManager) {}

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

	/**
	 * @template T of object
	 *
	 * @psalm-param class-string<T> $entityClass
	 *
	 * @psalm-return EntityRepository<T>
	 *
	 * @throws NotSupported
	 */
	protected function repository(string $entityClass): EntityRepository
	{
		return $this->entityManager->getRepository($entityClass);
	}
}
