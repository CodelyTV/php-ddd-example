<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Notification;

use Abraham\TwitterOAuth\TwitterOAuth;
use CodelyTv\Shared\Domain\Notification\Notification;
use CodelyTv\Shared\Domain\Notification\Notificator;

final class TwitterNotificator implements Notificator
{
    private readonly TwitterOAuth $client;

    public function __construct(string $key, string $secret, string $accessToken, string $accessTokenSecret)
    {
        $this->client = new TwitterOAuth($key, $secret, $accessToken, $accessTokenSecret);
    }

    public function notify(Notification $notification): void
    {
        $this->client->post("statuses/update", ["status" => $notification->getText()]);
    }
}
