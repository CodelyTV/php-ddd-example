<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use TwitterAPIExchange;

final class TwitterClient
{
    const PUBLISH_TWIT_ENDPOINT = 'https://api.twitter.com/1.1/statuses/update.json';

    private $client;

    public function __construct(
        string $oauthAccessToken,
        string $oauthAccessTokenSecret,
        string $consumerKey,
        string $consumerSecret
    ) {

        $settings = [
            'oauth_access_token' => $oauthAccessToken,
            'oauth_access_token_secret' => $oauthAccessTokenSecret,
            'consumer_key' => $consumerKey,
            'consumer_secret' => $consumerSecret
        ];

        $this->client = new TwitterAPIExchange($settings);
    }

    public function twit(string $status)
    {
        $this->client->buildOauth(self::PUBLISH_TWIT_ENDPOINT, 'POST')
            ->setPostfields([
                'status' => urlencode($status)
            ])
            ->performRequest()
        ;
    }
}
