<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class VideoEmpty extends DomainError
{

    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'any_video_found';
    }

    protected function errorMessage(): string
    {
        return sprintf(' There is any video registered');
    }
}
