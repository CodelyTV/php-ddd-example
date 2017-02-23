<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Notification\Domain\Notifier;
use Maknz\Slack\Client;
use function Lambdish\Phunctional\get;

final class SlackNotifier implements Notifier
{
    const UNKNOWN_NOTIFICATION = '( ͡° ͜ʖ ͡°)';

    private static $actionsFaces = [
        NotificationType::VIDEO_CREATED => '(｡◕‿◕｡)',
    ];

    private $client;

    public function __construct(string $hookUrl, array $settings)
    {
        $this->client = new Client($hookUrl, $settings);
    }

    public function notify(NotificationText $text, NotificationType $action)
    {
        $message = $this->client->createMessage();

        $message->setText(
            sprintf('%s %s', get($action->value(), self::$actionsFaces, self::UNKNOWN_NOTIFICATION), $text->value())
        );

        $this->client->sendMessage($message);
    }
}
