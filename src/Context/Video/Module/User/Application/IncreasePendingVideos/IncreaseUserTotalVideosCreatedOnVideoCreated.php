<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Context\Video\Module\User\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use function Lambdish\Phunctional\apply;

final class IncreaseUserTotalVideosCreatedOnVideoCreated
{
    private $increaser;

    public function __construct(UserTotalVideosCreatedIncreaser $increaser)
    {
        $this->increaser = $increaser;
    }

    public static function subscribedTo(): array
    {
        return [ScalaVideoCreatedDomainEvent::class];
    }

    public function __invoke(ScalaVideoCreatedDomainEvent $event)
    {
        $id = new UserId($event->creatorId());

        apply($this->increaser, [$id]);
    }
}
