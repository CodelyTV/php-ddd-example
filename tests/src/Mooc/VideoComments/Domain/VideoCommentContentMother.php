<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComments\Domain;

use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Test\Shared\Domain\TextMother;

final class VideoCommentContentMother
{
    private const MIN_LENGTH = 20;

    public static function create(string $content): VideoCommentContent
    {
        return new VideoCommentContent($content);
    }

    public static function random(): VideoCommentContent
    {
        return self::create(TextMother::withMinLength(self::MIN_LENGTH));
    }
}
