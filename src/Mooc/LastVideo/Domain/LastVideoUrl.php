<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;

final class LastVideoUrl extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValidUrl($value);

        parent::__construct($value);
    }

    private function ensureIsValidUrl(string $url): void
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(sprintf('The url <%s> is not well formatted', $url));
        }
    }
}
