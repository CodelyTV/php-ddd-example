<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * VideoLikeCreatedDomainEvent
 */
class VideoLikeCreatedDomainEvent extends DomainEvent
{

    public static function eventName(): string
    {
        return 'video_like_created';
    }

    protected function rules(): array
    {
        return [
            'userId' => ['string'],
            'videoId' => ['string'],
        ];
    }
}