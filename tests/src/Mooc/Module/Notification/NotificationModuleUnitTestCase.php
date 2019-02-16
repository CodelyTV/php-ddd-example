<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Notification;

use CodelyTv\Mooc\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Mooc\MoocContextUnitTestCase;
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
