<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Infrastructure\IO;

use Abraham\TwitterOAuth\TwitterOAuth;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\ShareRepository;

final class TwitterShareRepository implements ShareRepository
{
    private TwitterOAuth $twitterOAuth;

    public function __construct()
    {
        $this->twitterOAuth = new TwitterOAuth($_ENV['TWITTER_API_KEY'],$_ENV['TWITTER_API_SECRET'],$_ENV['TWITTER_CONSUMER_API_KEY'], $_ENV['TWITTER_CONSUMER_API_SECRET_KEY']);
    }

    public function share(Course $course): void
    {
        $connection = $this->twitterOAuth;
 
        $status = 'CodelyTV have awesome courses like '.$course->name();
        $connection->post("statuses/update", ["status" => $status]);

    }
}
