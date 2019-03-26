<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Challenge;

use CodelyTv\Mooc\Steps\Domain\StepCreatedDomainEvent;

/**
 * @method string statement()
 */
final class ChallengeStepCreatedDomainEvent extends StepCreatedDomainEvent
{
    public static function eventName(): string
    {
        return 'challenge_step_created';
    }

    protected function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'statement' => ['string'],
            ]
        );
    }
}
