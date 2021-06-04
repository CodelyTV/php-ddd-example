<?php

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\Share\Twitter;

use CodelyTv\Mooc\Videos\Infrastructure\SocialMedia\Twitter\TwitterClient;
use PHPUnit\Framework\TestCase;

class TwitterClientTest extends TestCase
{
    public function testTweetIsPublished()
    {
        $status = "Hola mundo";
        $twitter_client = new TwitterClient();
        $twitter_response = $twitter_client->post($status);
        $this->assertIsObject($twitter_response);
    }
}
