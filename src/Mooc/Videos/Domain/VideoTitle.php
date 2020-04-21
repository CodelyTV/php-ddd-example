<?php


namespace CodelyTv\Mooc\Videos\Domain;


use CodelyTv\Shared\Domain\ValueObject\StringValueObject;

final class VideoTitle extends StringValueObject
{
    public function __construct(string $value)
    {
        if (!$value) {
            throw new \InvalidArgumentException("title should not be empty");
        }
        parent::__construct($value);

    }
}