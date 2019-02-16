<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Notification;

use CodelyTv\Mooc\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Mooc\MoocContextFunctionalTestCase;

abstract class NotificationModuleFunctionalTestCase extends MoocContextFunctionalTestCase
{
    protected function repository(): NotificationRepository
    {
        return $this->service('codely.mooc.notification.repository');
    }
}
