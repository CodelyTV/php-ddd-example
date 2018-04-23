<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string videoId()
 * @method string rating()
 * @method string text()
 */
final class ReviewCreatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'review_created';
    }

    protected function rules(): array
    {
        return [
            'videoId' => ['string'],
            'rating' => ['int'],
            'text' => ['string'],
        ];
    }
}
