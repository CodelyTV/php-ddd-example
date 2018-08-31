<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Exception\DomainError;

final class VideoNotFoundLast extends DomainError
{
    public function errorCode(): string
    {
        return 'video_not_found_last';
    }

    protected function errorMessage(): string
    {
        return 'The last video has not been found';
    }
}
