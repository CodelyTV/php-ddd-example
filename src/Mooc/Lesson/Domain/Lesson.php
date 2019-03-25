<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lesson\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;

final class Lesson
{
    private $id;
    private $courseId;
    private $title;
    private $description;
    private $estimatedDuration;
    private $order;
    private $scheduledDate;
    private $requireSubscription;

    public function __construct(
        LessonId $id,
        CourseId $courseId,
        LessonTitle $title,
        LessonDescription $description,
        LessonEstimatedDuration $estimatedDuration,
        LessonOrder $order,
        LessonScheduledDate $scheduledDate,
        bool $requireSubscription
    ) {
        $this->id                  = $id;
        $this->courseId            = $courseId;
        $this->title               = $title;
        $this->description         = $description;
        $this->estimatedDuration   = $estimatedDuration;
        $this->order               = $order;
        $this->scheduledDate       = $scheduledDate;
        $this->requireSubscription = $requireSubscription;
    }

    public function id(): LessonId
    {
        return $this->id;
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }

    public function title(): LessonTitle
    {
        return $this->title;
    }

    public function description(): LessonDescription
    {
        return $this->description;
    }

    public function estimatedDuration(): LessonEstimatedDuration
    {
        return $this->estimatedDuration;
    }

    public function order(): LessonOrder
    {
        return $this->order;
    }

    public function scheduledDate(): LessonScheduledDate
    {
        return $this->scheduledDate;
    }

    public function requireSubscription(): bool
    {
        return $this->requireSubscription;
    }
}
