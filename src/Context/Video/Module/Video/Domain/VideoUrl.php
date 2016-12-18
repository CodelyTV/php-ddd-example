<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Types\ValueObject\StringValueObject;

final class VideoUrl extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->guardValidUrl($value);

        parent::__construct($value);
    }

    private function guardValidUrl(string $url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf('The url <%s> is not well formatted', $url));
        }
    }
}
