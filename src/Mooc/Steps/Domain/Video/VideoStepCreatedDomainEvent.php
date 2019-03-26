<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Steps\Domain\StepCreatedDomainEvent;

/**
 * @method string url()
 * @method string text()
 */
final class VideoStepCreatedDomainEvent extends StepCreatedDomainEvent
{
    public static function eventName(): string
    {
        return 'video_step_created';
    }

    protected function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                'url'  => ['string'],
                'text' => ['string'],
            ]
        );
    }
}
