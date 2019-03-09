<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Contract;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string videoId
 * @method string content
 */
final class VideoCommentPublishedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'video_comment_published';
    }

    protected function rules(): array
    {
        return [
            'videoId' => ['string'],
            'content' => ['string'],
        ];
    }
}
