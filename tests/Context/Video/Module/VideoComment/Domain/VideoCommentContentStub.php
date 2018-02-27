<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\VideoComment\Domain;

use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Test\Shared\Domain\TextStub;

final class VideoCommentContentStub
{
    private const MIN_LENGTH = 20;

    public static function create(string $content): VideoCommentContent
    {
        return new VideoCommentContent($content);
    }

    public static function random(): VideoCommentContent
    {
        return self::create(TextStub::withMinLength(self::MIN_LENGTH));
    }
}
