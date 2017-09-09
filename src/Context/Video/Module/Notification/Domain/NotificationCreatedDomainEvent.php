<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string text()
 * @method string type()
 */
final class NotificationCreatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'notification_created';
    }

    protected function rules(): array
    {
        return [
            'text' => ['string'],
            'type' => ['string'],
        ];
    }
}
