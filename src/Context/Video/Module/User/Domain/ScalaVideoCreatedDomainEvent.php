<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string creatorId()
 */
final class ScalaVideoCreatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'codelytv_scala_api.video_created';
    }

    protected function rules(): array
    {
        return [
            'creatorId' => ['string'],
        ];
    }
}
