<?php

declare(strict_types=1);

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\Bus\Query\Response;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use function Lambdish\Phunctional\apply;

final class TransactionalWrapper
{
    private $entityManager;
    private $publisher;
    private $service;

    public function __construct(
        EntityManagerInterface $entityManager,
        DomainEventPublisher $publisher,
        callable $service
    ) {
        $this->entityManager = $entityManager;
        $this->publisher     = $publisher;
        $this->service       = $service;
    }

    public function __invoke(...$args): ?Response
    {
        $result = null;

        $this->entityManager->beginTransaction();

        try {
            $result = apply($this->service, $args);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (Exception $exception) {
            $this->entityManager->close();
            $this->entityManager->rollback();

            throw new WrongTransaction($exception);
        }

        $this->publisher->publishRecorded();

        return $result;
    }
}
