<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStep;
use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Test\Mooc\Shared\Domain\Lessons\LessonIdMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepEstimatedDurationMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepIdMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepOrderMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepTitleMother;
use CodelyTv\Test\Shared\Domain\DateTimeMother;
use CodelyTv\Test\Shared\Domain\RepeatMother;
use DateTimeImmutable;

final class QuizStepMother
{
    public static function create(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        QuizStepQuestion ...$questions
    ): QuizStep {
        return new QuizStep($id, $lessonId, $title, $estimatedDuration, $order, $creationDate, ...$questions);
    }

    public static function random(): QuizStep
    {
        return self::create(
            StepIdMother::random(),
            LessonIdMother::random(),
            StepTitleMother::random(),
            StepEstimatedDurationMother::random(),
            StepOrderMother::random(),
            DateTimeMother::random(),
            ...RepeatMother::random(QuizStepQuestionMother::creator())
        );
    }
}
