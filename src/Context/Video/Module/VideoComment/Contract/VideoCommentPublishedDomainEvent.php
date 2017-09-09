<?php

namespace CodelyTv\Context\Video\Module\VideoComment\Contract;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string videoId
 * @method string content
 */
final class VideoCommentPublishedDomainEvent extends DomainEvent
{
    protected function rules(): array
    {
        return [
            'videoId' => ['string'],
            'content' => ['string'],
        ];
    }
}
