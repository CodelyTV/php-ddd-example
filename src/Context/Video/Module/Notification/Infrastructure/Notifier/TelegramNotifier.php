<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Context\Video\Module\Notification\Domain\Notifier;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;

use \TelegramBot\Api\BotApi;

final class TelegramNotifier implements Notifier
{
    private $client;
    private $channel;

    public function __construct(
        String $botToken,
        String $channel
    ) {
        $this->client = new BotApi($botToken);
        $this->channel = '@'.$channel;
    }

    public function notify(NotificationText $text, NotificationType $action)
    {
        $this->client->sendMessage($this->channel, $text->value());
    }
}
