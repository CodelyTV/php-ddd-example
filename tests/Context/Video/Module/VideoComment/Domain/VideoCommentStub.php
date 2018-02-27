<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\VideoComment\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoComment;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentId;

final class VideoCommentStub
{
    public static function create(VideoCommentId $id, VideoId $videoId, VideoCommentContent $content): VideoComment
    {
        return new VideoComment($id, $videoId, $content);
    }

    public static function random(): VideoComment
    {
        return self::create(
            VideoCommentIdStub::random(),
            VideoIdStub::random(),
            VideoCommentContentStub::random()
        );
    }
}
