<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Challenge;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Mooc\Steps\Domain\StepPoints;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use DateTimeImmutable;
use function CodelyTv\Utils\Shared\date_to_string;

final class ChallengeStep extends Step
{
    private $statement;

    public function __construct(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        ChallengeStepStatement $statement
    ) {
        parent::__construct($id, $lessonId, $title, $estimatedDuration, $order, $creationDate);

        $this->statement = $statement;
    }

    public static function create(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        ChallengeStepStatement $statement
    ): self {
        $step = new self($id, $lessonId, $title, $estimatedDuration, $order, new DateTimeImmutable(), $statement);

        $step->record(
            new ChallengeStepCreatedDomainEvent(
                $id->value(),
                [
                    'lessonId'          => $lessonId->value(),
                    'title'             => $title->value(),
                    'estimatedDuration' => $estimatedDuration->value(),
                    'creationDate'      => date_to_string($step->creationDate()),
                    'statement'         => $statement->value(),
                ]
            )
        );

        return $step;
    }

    public function points(): StepPoints
    {
        return new StepPoints(5);
    }

    public function statement(): ChallengeStepStatement
    {
        return $this->statement;
    }
}
