<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Infrastructure\Notifier;

use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Mooc\Notifications\Domain\Notifier;
use CodelyTv\Shared\Domain\EmailAddress;
use function Lambdish\Phunctional\get;

final class EmailNotifier implements Notifier
{
    private const NOTIFY_FROM          = 'notifications@codely.tv';
    private const NOTIFY_TO            = 'hi@codely.tv';
    private const UNKNOWN_NOTIFICATION = 'Unknown Notification';
    private static $subjects = [
        NotificationType::VIDEO_CREATED => 'New video, yeah!',
    ];
    private $client;

    public function __construct(string $username, string $password)
    {
        $this->client = new GmailSwiftMailerEmailClient($username, $password);
    }

    public function notify(NotificationText $text, NotificationType $action): void
    {
        $from    = new EmailAddress(self::NOTIFY_FROM);
        $to      = new EmailAddress(self::NOTIFY_TO);
        $subject = get($action->value(), self::$subjects, self::UNKNOWN_NOTIFICATION);

        $this->client->send($from, $to, $subject, $text->value());
    }
}
