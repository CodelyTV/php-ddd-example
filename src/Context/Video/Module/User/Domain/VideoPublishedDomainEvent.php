<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class VideoPublishedDomainEvent extends DomainEvent
{
    protected function rules(): array
    {
        return [];
    }

    public static function eventName(): string
    {
        return 'codelytv_scala_api.video_created';
    }
}
