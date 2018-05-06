<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Create;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\CourseId;

final class CreateCourseOpinionCommandHandler
{
    private $creator;

    public function __construct(CourseOpinionCreator $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param CreateCourseOpinionCommand $command
     *
     * @throws \Exception
     */
    public function __invoke(CreateCourseOpinionCommand $command)
    {
        $courseId = new CourseId($command->courseId());
        $id       = new CourseOpinionId($command->id());
        $rating   = new CourseOpinionRating($command->rating());
        $text     = new CourseOpinionText($command->text());

        $this->creator->create($courseId, $id, $rating, $text);
    }
}
