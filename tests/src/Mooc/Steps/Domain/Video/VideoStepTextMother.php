<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Steps\Domain\Video\VideoStepText;
use CodelyTv\Test\Shared\Domain\TextMother;

final class VideoStepTextMother
{
    public static function create(string $value): VideoStepText
    {
        return new VideoStepText($value);
    }

    public static function random(): VideoStepText
    {
        return self::create(TextMother::random());
    }
}
