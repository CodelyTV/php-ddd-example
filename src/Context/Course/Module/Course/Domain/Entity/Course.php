<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Domain\Entity;

use CodelyTv\Context\Course\Module\Course\Domain\Event\CourseCreatedDomainEvent;
use CodelyTv\Context\Course\Module\Course\Domain\Event\CourseRatingUpdatedDomainEvent;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseRating;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class Course extends AggregateRoot
{
    private $id;
    private $title;
    private $description;
    private $rating;

    private function __construct(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->rating      = new CourseRating(0);
    }

    public static function create(CourseId $id, CourseTitle $title, CourseDescription $description): Course
    {
        $course = new self($id, $title, $description);

        $course->record(
            new CourseCreatedDomainEvent(
                $id->value(),
                [
                    'title'       => $title->value(),
                    'description' => $description->value(),
                ]
            )
        );

        return $course;
    }

    public function rating(): CourseRating
    {
        return $this->rating;
    }

    public function updateRating(CourseRating $rating): void
    {
        $this->rating = $rating;

        $this->record(
            new CourseRatingUpdatedDomainEvent(
                $this->id()->value(),
                [
                    'title'       => $this->title()->value(),
                    'description' => $this->description()->value(),
                    'rating'      => $rating->value(),
                ]
            )
        );
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
