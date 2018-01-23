<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class Course extends AggregateRoot
{
    private $id;
    private $title;
    private $description;

    private function __construct(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
    }

    public static function create(CourseId $id, CourseTitle $title, CourseDescription $description): Course
    {
        $course = new self($id, $title, $description);

        $course->record(
            new CourseCreatedDomainEvent(
                $id,
                [
                    'title'       => $title->value(),
                    'description' => $description->value(),
                ]
            )
        );

        return $course;
    }

    public function id(): CourseId
    {
        return $this->id;
    }

    public function title(): CourseTitle
    {
        return $this->title;
    }

    public function description(): CourseDescription
    {
        return $this->description;
    }
}
