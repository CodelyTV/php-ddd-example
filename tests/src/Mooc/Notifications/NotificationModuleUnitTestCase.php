<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Notifications;

use CodelyTv\Mooc\Notifications\Domain\NotificationRepository;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use Mockery\MockInterface;

abstract class NotificationModuleUnitTestCase extends MoocContextUnitTestCase
{
    private $repository;

    /** @return NotificationRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(NotificationRepository::class);
    }
}
