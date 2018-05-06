<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionPublishedDomainEvent;
use CodelyTv\Shared\Domain\CourseId;

final class RateCourseOnCourseOpinionCreated
{
    private $updater;

    public function __construct(CourseRatingUpdater $updater)
    {
        $this->updater = $updater;
    }

    public static function subscribedTo(): array
    {
        return [CourseOpinionPublishedDomainEvent::class];
    }

    /**
     * @param CourseOpinionPublishedDomainEvent $event
     *
     * @throws \Exception
     */
    public function __invoke(CourseOpinionPublishedDomainEvent $event)
    {
        $id = new CourseId($event->courseId());

        $this->updater->updateRating($id);
    }
}
