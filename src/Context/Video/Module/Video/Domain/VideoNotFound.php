<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Exception\DomainError;

final class VideoNotFound extends DomainError
{
    private $id;

    public function __construct(VideoId $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'video_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The video <%s> has not been found', $this->id->value());
    }
}
