<?php

namespace CodelyTv\Mooc\Videos\Infrastructure\Share\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use CodelyTv\Mooc\Videos\Domain\SocialMediaVideoPublished;

class TwitterClient implements SocialMediaVideoPublished
{

    private TwitterOAuth $connection;

    public function __construct()
    {
        $twitter_consumer_key = $_SERVER['TWITTER_CONSUMER_KEY'];
        $twitter_consumer_secret = $_SERVER['TWITTER_CONSUMER_SECRET'];
        $twitter_access_token = $_SERVER['TWITTER_ACCESS_TOKEN'];
        $twitter_access_token_secret = $_SERVER['TWITTER_ACCESS_TOKEN_SECRET'];

        $this->connection = new TwitterOAuth (
            $twitter_consumer_key,
            $twitter_consumer_secret,
            $twitter_access_token,
            $twitter_access_token_secret
        );
    }

    /**
     * @param string $status
     *
     * @return array|object
     */
    public function post(string $status)
    {
        return $this->connection->post("statuses/update", ["status" => $status]);
    }
}
