<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\User\Application\IncreasePendingVideos;

use CodelyTv\Mooc\Module\User\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Mooc\Module\User\Domain\UserId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class IncreaseUserTotalVideosCreatedOnVideoCreated implements DomainEventSubscriber
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
