<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Domain;

final class VideoCommentContent
{
    private const MIN_LENGTH = 20;
    private $value;

    public function __construct(string $value)
    {
        $this->ensureHasMinimumLength($value);

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function ensureHasMinimumLength(string $content): void
    {
        $contentLength = strlen($content);

        if ($contentLength < self::MIN_LENGTH) {
            throw new \InvalidArgumentException(
                sprintf('The min length for a comment is %s, %s received', self::MIN_LENGTH, $contentLength)
            );
        }
    }
}
