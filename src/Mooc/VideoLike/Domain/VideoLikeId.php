<?php

namespace CodelyTv\Mooc\VideoLike\Domain;

class VideoLikeId
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}