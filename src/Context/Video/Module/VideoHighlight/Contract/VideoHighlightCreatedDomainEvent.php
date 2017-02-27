<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Contract;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method int    from()
 * @method int    to()
 * @method string message()
 */
final class VideoHighlightCreatedDomainEvent extends DomainEvent
{
    protected function rules(): array
    {
        return [
            'from'    => ['int'],
            'to'      => ['int'],
            'message' => ['string'],
        ];
    }
}
