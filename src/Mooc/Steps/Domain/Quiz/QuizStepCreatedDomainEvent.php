<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\StepCreatedDomainEvent;

final class QuizStepCreatedDomainEvent extends StepCreatedDomainEvent
{
    public static function eventName(): string
    {
        return 'quiz_step_created';
    }

    protected function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'questions' => ['array'],
            ]
        );
    }
}
