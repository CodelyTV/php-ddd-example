<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Application\Update;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoCreatedAt;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoTitle;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoType;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoUrl;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class UpdateLastVideoOnVideoCreated implements DomainEventSubscriber
{
    public function __construct(private readonly LastVideoUpdater $updater)
    {
    }

    public static function subscribedTo(): array
    {
        return [VideoCreatedDomainEvent::class];
    }

    public function __invoke(VideoCreatedDomainEvent $event): void
    {
        $videoId = new VideoId($event->aggregateId());
        $videoPrimitives = $event->toPrimitives();
        $videoType = new LastVideoType($videoPrimitives['type']);
        $videoTitle = new LastVideoTitle($videoPrimitives['title']);
        $videoUrl = new LastVideoUrl($videoPrimitives['url']);
        $videoCourseId = new CourseId($videoPrimitives['course_id']);
        $videoCreatedAt = new LastVideoCreatedAt($event->occurredOn());

        apply($this->updater, [$videoId, $videoType, $videoTitle, $videoUrl, $videoCourseId, $videoCreatedAt]);
    }
}
