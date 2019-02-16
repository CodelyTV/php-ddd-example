<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComment\Domain;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\VideoComment\Domain\VideoComment;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentId;

final class VideoCommentMother
{
    public static function create(VideoCommentId $id, VideoId $videoId, VideoCommentContent $content): VideoComment
    {
        return new VideoComment($id, $videoId, $content);
    }

    public static function random(): VideoComment
    {
        return self::create(
            VideoCommentIdMother::random(),
            VideoIdMother::random(),
            VideoCommentContentMother::random()
        );
    }
}
