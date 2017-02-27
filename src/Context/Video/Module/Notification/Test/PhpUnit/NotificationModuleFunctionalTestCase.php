<?php

namespace CodelyTv\Context\Video\Module\Notification\Test\PhpUnit;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationRepository;
use CodelyTv\Context\Video\Test\PhpUnit\VideoContextFunctionalTestCase;

abstract class NotificationModuleFunctionalTestCase extends VideoContextFunctionalTestCase
{
    protected function repository(): NotificationRepository
    {
        return $this->service('codely.video.notification.repository');
    }
}
