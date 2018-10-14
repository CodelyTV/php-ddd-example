<?php

namespace CodelyTv\Context\Video\Module\VideoComment\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoComment;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class VideoCommentRepositoryMySql extends Repository implements VideoCommentRepository
{
    public function save(VideoComment $comment)
    {
        return $this->persist($comment);
    }
}
