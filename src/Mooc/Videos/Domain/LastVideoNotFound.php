<?php


namespace CodelyTv\Mooc\Videos\Domain;


use CodelyTv\Shared\Domain\DomainError;

final class LastVideoNotFound extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'video_not_found';
    }

    protected function errorMessage(): string
    {
        return 'Last video has not been found';
    }

}