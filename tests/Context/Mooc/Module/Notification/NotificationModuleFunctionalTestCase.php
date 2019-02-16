<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc\Module\Notification;

use CodelyTv\Context\Mooc\Module\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Context\Mooc\MoocContextFunctionalTestCase;

abstract class NotificationModuleFunctionalTestCase extends MoocContextFunctionalTestCase
{
    protected function repository(): NotificationRepository
    {
        return $this->service('codely.mooc.notification.repository');
    }
}
