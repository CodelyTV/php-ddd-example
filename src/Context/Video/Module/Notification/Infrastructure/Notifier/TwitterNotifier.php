<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Notification\Domain\Notifier;
use function Lambdish\Phunctional\get;

class TwitterNotifier implements Notifier
{
    const UNKNOWN_NOTIFICATION = 'Unknown notification';

    private static $subjects = [
        NotificationType::VIDEO_CREATED => 'New video, yeah!',
    ];

    private $twitter;

    public function __construct(TwitterClient $twitter)
    {
        $this->twitter = $twitter;
    }

    public function notify(NotificationText $text, NotificationType $action)
    {
        $status = $this->composeStatus($text, $action);

        $this->twitter->twit($status);
    }

    private function composeStatus(NotificationText $text, NotificationType $action): string
    {
        $notification = get($action->value(), self::$subjects, self::UNKNOWN_NOTIFICATION);
        $status = sprintf('%s %s', $notification, $text->value());

        return $status;
    }
}
