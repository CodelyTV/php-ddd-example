<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Application\Find;

use CodelyTv\Mooc\LastVideo\Domain\LastVideo;

final class LastVideoResponseConverter
{
    public function __invoke(LastVideo $lastVideo): LastVideoResponse
    {
        return new LastVideoResponse(
            $lastVideo->videoId()->value(),
            $lastVideo->type()->value(),
            $lastVideo->title()->value(),
            $lastVideo->url()->value(),
            $lastVideo->courseId()->value()
        );
    }
}
