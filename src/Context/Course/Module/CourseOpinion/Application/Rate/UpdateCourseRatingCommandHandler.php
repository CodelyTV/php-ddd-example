<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Shared\Domain\CourseId;

final class UpdateCourseRatingCommandHandler
{
    private $updater;

    public function __construct(CourseRatingUpdater $updater)
    {
        $this->updater = $updater;
    }

    /**
     * @param UpdateCourseRatingCommand $command
     *
     * @throws \Exception
     */
    public function __invoke(UpdateCourseRatingCommand $command): void
    {
        $courseId = new CourseId($command->id());

        $this->updater->updateRating($courseId);
    }
}
