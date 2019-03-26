<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class NoVideos extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'no_videos_stored';
    }

    protected function errorMessage(): string
    {
        return sprintf('No video stored, yet.');
    }
}
