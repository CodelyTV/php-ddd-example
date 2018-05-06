<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject;

final class CourseOpinionText
{
    private const MAX_LENGTH = 300;

    private $value;

    /**
     * @param string $value
     *
     * @throws \Exception
     */
    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    /**
     * @param string $content
     *
     * @throws \Exception
     */
    private function guard(string $content): void
    {
        $contentLength = \strlen($content);

        if ($contentLength > self::MAX_LENGTH) {
            throw new \InvalidArgumentException(
                sprintf('The max length for a comment is %d, %d received', self::MAX_LENGTH, $contentLength)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function needsValidation(): bool
    {
        return \strlen($this->value()) > 0;
    }
}
