<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;

final class PublishCourseOpinionCommandHandler
{
    private $publisher;

    public function __construct(CourseOpinionPublisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @param PublishCourseOpinionCommand $command
     *
     * @throws \Exception
     */
    public function __invoke(PublishCourseOpinionCommand $command)
    {
        $courseOpinionId = new CourseOpinionId($command->id());

        $this->publisher->publish($courseOpinionId);
    }
}
