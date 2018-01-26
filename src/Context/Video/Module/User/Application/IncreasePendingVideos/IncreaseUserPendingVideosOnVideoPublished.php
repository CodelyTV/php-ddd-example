<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Video\Module\User\Domain\VideoPublishedDomainEvent;
use function Lambdish\Phunctional\apply;

final class IncreaseUserPendingVideosOnVideoPublished
{
    private $increaser;

    public function __construct(UserPendingVideosIncreaser $increaser)
    {
        $this->increaser = $increaser;
    }

    public static function subscribedTo(): array
    {
        return [VideoPublishedDomainEvent::class];
    }

    public function __invoke(VideoPublishedDomainEvent $domainEvent)
    {
        apply($this->increaser);
    }
}
