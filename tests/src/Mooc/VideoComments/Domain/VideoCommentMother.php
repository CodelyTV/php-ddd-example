<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComments\Domain;

use CodelyTv\Mooc\VideoComments\Domain\VideoComment;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;

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
