<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc\Module\Notification;

use CodelyTv\Context\Mooc\Module\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Context\Mooc\MoocContextUnitTestCase;
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
