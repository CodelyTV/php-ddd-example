<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Infrastructure\Notifier;

use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Mooc\Notifications\Domain\Notifier;
use Maknz\Slack\Client;
use function Lambdish\Phunctional\get;

final class SlackNotifier implements Notifier
{
    private const UNKNOWN_NOTIFICATION = '( ͡° ͜ʖ ͡°)';
    private static $actionsFaces = [
        NotificationType::VIDEO_CREATED => '(｡◕‿◕｡)',
    ];
    private $client;

    public function __construct(string $hookUrl, array $settings)
    {
        $this->client = new Client($hookUrl, $settings);
    }

    public function notify(NotificationText $text, NotificationType $action): void
    {
        $message = $this->client->createMessage();

        $message->setText(
            sprintf('%s %s', get($action->value(), self::$actionsFaces, self::UNKNOWN_NOTIFICATION), $text->value())
        );

        $this->client->sendMessage($message);
    }
}
