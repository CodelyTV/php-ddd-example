<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Mooc\Steps\Domain\StepPoints;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use DateTimeImmutable;

final class QuizStep extends Step
{
    private $questions;

    public function __construct(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        QuizStepQuestion ...$questions
    ) {
        parent::__construct($id, $lessonId, $title, $estimatedDuration, $order, $creationDate);

        $this->questions = $questions;
    }

    public function points(): StepPoints
    {
        return new StepPoints(10);
    }

    public function questions(): array
    {
        return $this->questions;
    }
}
