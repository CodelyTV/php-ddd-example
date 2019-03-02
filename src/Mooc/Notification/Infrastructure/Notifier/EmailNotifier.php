<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Infrastructure\Notifier;

use CodelyTv\Mooc\Notification\Domain\NotificationText;
use CodelyTv\Mooc\Notification\Domain\NotificationType;
use CodelyTv\Mooc\Notification\Domain\Notifier;
use CodelyTv\Shared\Domain\EmailAddress;
use function Lambdish\Phunctional\get;

final class EmailNotifier implements Notifier
{
    public const NOTIFY_FROM          = 'notifications@codely.tv';
    public const NOTIFY_TO            = 'hi@codely.tv';
    public const UNKNOWN_NOTIFICATION = 'Unknown Notification';

    private static $subjects = [
        NotificationType::VIDEO_CREATED => 'New video, yeah!',
    ];

    private $client;

    public function __construct(string $username, string $password)
    {
        $this->client = new GmailSwiftMailerEmailClient($username, $password);
    }

    public function notify(NotificationText $text, NotificationType $action)
    {
        $from    = new EmailAddress(self::NOTIFY_FROM);
        $to      = new EmailAddress(self::NOTIFY_TO);
        $subject = get($action->value(), self::$subjects, self::UNKNOWN_NOTIFICATION);

        $this->client->send($from, $to, $subject, $text->value());
    }
}
