<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\IncreasePendingVideos;

use CodelyTv\Mooc\Students\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class IncreaseStudentTotalVideosCreatedOnVideoCreated implements DomainEventSubscriber
{
    private $increaser;

    public function __construct(StudentTotalVideosCreatedIncreaser $increaser)
    {
        $this->increaser = $increaser;
    }

    public static function subscribedTo(): array
    {
        return [ScalaVideoCreatedDomainEvent::class];
    }

    public function __invoke(ScalaVideoCreatedDomainEvent $event)
    {
        $id = new StudentId($event->creatorId());

        apply($this->increaser, [$id]);
    }
}
