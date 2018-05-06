<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEvent;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionPublishedDomainEvent;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionPublished;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class CourseOpinion extends AggregateRoot
{
    private $courseId;
    private $id;
    private $rating;
    private $text;
    private $published;

    public function __construct(
        CourseId $courseId,
        CourseOpinionId $id,
        CourseOpinionRating $rating,
        CourseOpinionText $text
    )
    {
        $this->courseId  = $courseId;
        $this->id        = $id;
        $this->rating    = $rating;
        $this->text      = $text;
        $this->published = new CourseOpinionPublished(false);
    }

    public static function create(
        CourseId $courseId,
        CourseOpinionId $id,
        CourseOpinionRating $rating,
        CourseOpinionText $text
    ): CourseOpinion
    {
        $opinion = new self($courseId, $id, $rating, $text);

        $opinion->record(
            new CourseOpinionCreatedDomainEvent(
                $id->value(),
                [
                    'courseId' => $courseId->value(),
                    'rating'   => $rating->value(),
                    'text'     => $text->value(),
                ]
            )
        );

        return $opinion;
    }

    public function publish(): void
    {
        $this->published = new CourseOpinionPublished(true);

        $this->record(
            new CourseOpinionPublishedDomainEvent(
                $this->id->value(),
                [
                    'courseId' => $this->courseId()->value(),
                    'rating'   => $this->rating()->value(),
                    'text'     => $this->text()->value(),
                ]
            )
        );
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }

    public function rating(): CourseOpinionRating
    {
        return $this->rating;
    }

    public function text(): CourseOpinionText
    {
        return $this->text;
    }

    public function id(): CourseOpinionId
    {
        return $this->id;
    }

    public function published(): CourseOpinionPublished
    {
        return $this->published;
    }
}
