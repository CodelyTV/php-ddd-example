<?php

namespace CodelyTv\Context\Video\Module\VideoComment\Domain;

final class VideoCommentContent
{
    const MIN_VIDEO_LENGTH = 20;

    private $value;

    public function __construct(string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function guard(string $content)
    {
        $contentLength = strlen($content);

        if ($contentLength < self::MIN_VIDEO_LENGTH) {
            throw new \InvalidArgumentException(sprintf('The min length for a comment is %s, %s received'));
        }
    }
}
