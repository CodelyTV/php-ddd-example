<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method int    from()
 * @method int    to()
 * @method string message()
 */
final class VideoHighlightCreatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'video_highlight_created';
    }

    protected function rules(): array
    {
        return [
            'from'    => ['int'],
            'to'      => ['int'],
            'message' => ['string'],
        ];
    }
}
