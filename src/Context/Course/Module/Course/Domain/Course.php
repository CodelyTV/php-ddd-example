<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

/**
 * Course
 */
final class Course extends AggregateRoot
{
    /**
     * @var CourseId
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;

    /**
     * Course constructor.
     *
     * @param CourseId $id
     * @param CourseTitle $title
     * @param CourseDescription $description
     */
    private function __construct(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public static function create(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        $course = new self($id, $title, $description);

        $course->record(
            new CourseCreatedDomainEvent(
                $id,
                [
                    'title' => $title->value(),
                    'description' => $description->value(),
                ]
            )
        );

        return $course;
    }

    /**
     * @return CourseId
     */
    public function id(): CourseId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }
}