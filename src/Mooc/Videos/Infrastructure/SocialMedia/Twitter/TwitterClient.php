<?php

namespace CodelyTv\Mooc\Videos\Infrastructure\SocialMedia\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use CodelyTv\Mooc\Videos\Domain\SocialMediaVideoPublished;

class TwitterClient implements SocialMediaVideoPublished
{

    private TwitterOAuth $connection;

    public function __construct()
    {
        $twitter_consumer_key = getenv('TWITTER_CONSUMER_KEY');
        $twitter_consumer_secret = getenv('TWITTER_CONSUMER_SECRET');
        $twitter_access_token = getenv('TWITTER_ACCESS_TOKEN');
        $twitter_access_token_secret = getenv('TWITTER_ACCESS_TOKEN_SECRET');

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
