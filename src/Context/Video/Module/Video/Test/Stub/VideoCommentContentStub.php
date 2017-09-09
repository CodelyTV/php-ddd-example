<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Test\Stub\TextStub;

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
