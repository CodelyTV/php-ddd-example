<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class LastVideoNotExist extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'last_video_not_exist';
    }

    protected function errorMessage(): string
    {
        return 'The last video not exist';
    }
}
