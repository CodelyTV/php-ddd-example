<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\SocialMedia\Twitter;

use CodelyTv\Mooc\Videos\Infrastructure\SocialMedia\Twitter\TwitterClient;
use PHPUnit\Framework\TestCase;

class TwitterClientTest extends TestCase
{
    public function testTweetIsPublished()
    {
        $status = "Hola mundo";
        $twitter_client = new TwitterClient();
        $twitter_client->post($status);
    }
}
