<?php

namespace CodelyTv\Test\Context\Video\Module\Notification;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Context\Video\VideoContextUnitTestCase;
use Mockery\MockInterface;

abstract class NotificationModuleUnitTestCase extends VideoContextUnitTestCase
{
    private $repository;

    /** @return NotificationRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(NotificationRepository::class);
    }
}
