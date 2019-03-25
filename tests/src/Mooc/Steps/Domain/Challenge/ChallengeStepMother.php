<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Challenge;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Domain\Challenge\ChallengeStep;
use CodelyTv\Mooc\Steps\Domain\Challenge\ChallengeStepStatement;
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
use DateTimeImmutable;

final class ChallengeStepMother
{
    public static function create(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        ChallengeStepStatement $statement
    ): ChallengeStep {
        return new ChallengeStep($id, $lessonId, $title, $estimatedDuration, $order, $creationDate, $statement);
    }

    public static function random(): ChallengeStep
    {
        return self::create(
            StepIdMother::random(),
            LessonIdMother::random(),
            StepTitleMother::random(),
            StepEstimatedDurationMother::random(),
            StepOrderMother::random(),
            DateTimeMother::random(),
            ChallengeStepStatementMother::random()
        );
    }
}
