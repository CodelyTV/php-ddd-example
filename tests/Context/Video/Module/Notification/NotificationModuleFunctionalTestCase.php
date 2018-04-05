<?php

namespace CodelyTv\Test\Context\Video\Module\Notification;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationRepository;
use CodelyTv\Test\Context\Video\VideoContextFunctionalTestCase;

abstract class NotificationModuleFunctionalTestCase extends VideoContextFunctionalTestCase
{
    protected function repository(): NotificationRepository
    {
        return $this->service('codely.video.notification.repository');
    }
}
