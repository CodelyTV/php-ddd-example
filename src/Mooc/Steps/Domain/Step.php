<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;

abstract class Step extends AggregateRoot
{
    private $id;
    private $lessonId;
    private $title;
    private $estimatedDuration;
    private $order;
    private $creationDate;

    public function __construct(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate
    ) {
        $this->id                = $id;
        $this->lessonId          = $lessonId;
        $this->title             = $title;
        $this->estimatedDuration = $estimatedDuration;
        $this->order             = $order;
        $this->creationDate      = $creationDate;
    }

    public function id(): StepId
    {
        return $this->id;
    }

    public function lessonId(): LessonId
    {
        return $this->lessonId;
    }

    public function title(): StepTitle
    {
        return $this->title;
    }

    public function estimatedDuration(): StepEstimatedDuration
    {
        return $this->estimatedDuration;
    }

    abstract public function points(): StepPoints;

    public function order(): StepOrder
    {
        return $this->order;
    }

    public function creationDate(): DateTimeImmutable
    {
        return $this->creationDate;
    }
}
