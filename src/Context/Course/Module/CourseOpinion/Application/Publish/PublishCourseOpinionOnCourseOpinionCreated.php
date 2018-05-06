<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEvent;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;

final class PublishCourseOpinionOnCourseOpinionCreated
{
    private $publisher;

    public function __construct(CourseOpinionPublisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public static function subscribedTo(): array
    {
        return [CourseOpinionCreatedDomainEvent::class];
    }

    /**
     * @param CourseOpinionCreatedDomainEvent $event
     *
     * @throws \Exception
     */
    public function __invoke(CourseOpinionCreatedDomainEvent $event)
    {
        if (empty($event->text())) {
            $id = new CourseOpinionId($event->aggregateId());

            $this->publisher->publish($id);
        }
    }
}
