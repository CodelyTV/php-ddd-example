<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain\Send;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationId;
use CodelyTv\Exception\DomainError;

final class NotificationNotFound extends DomainError
{
    private $id;

    public function __construct(NotificationId $id)
    {
        parent::__construct();

        $this->id = $id;
    }

    public function errorCode(): string
    {
        return 'notification_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The notification <%s> has not been found', $this->id()->value());
    }

    public function id(): NotificationId
    {
        return $this->id;
    }
}
