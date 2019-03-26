<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

abstract class StepCreatedDomainEvent extends DomainEvent
{
    protected function rules(): array
    {
        return [
            'lessonId'          => ['string'],
            'title'             => ['string'],
            'estimatedDuration' => ['int'],
            'creationDate'      => ['string'],
        ];
    }
}
