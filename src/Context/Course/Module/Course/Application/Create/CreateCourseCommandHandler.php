<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;

/**
 * CreateCourseCommandHandler
 */
final class CreateCourseCommandHandler
{
    /**
     * @var CourseCreator
     */
    private $creator;


    /**
     * CreateCourseCommandHandler constructor.
     *
     * @param CourseCreator $creator
     */
    public function __construct(CourseCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCourseCommand $command)
    {
        $id = new CourseId($command->id());
        $title = new CourseTitle($command->title());
        $description = new CourseDescription($command->description());

        $this->creator->create($id, $title, $description);
    }

}