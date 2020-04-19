<?php


namespace CodelyTv\Backoffice\Videos\Domain;


use CodelyTv\Shared\Domain\DomainError;

final class VideoNotExist extends DomainError
{
    private VideoId $id;

    public function __construct(VideoId $id)
    {
        $this->id = $id;
        parent::__construct();
    }

    public function errorCode(): string
    {
        // TODO: Implement errorCode() method.
    }

    protected function errorMessage(): string
    {
        return sprintf('The video <%s> does not exist', $this->id->value());
    }
}