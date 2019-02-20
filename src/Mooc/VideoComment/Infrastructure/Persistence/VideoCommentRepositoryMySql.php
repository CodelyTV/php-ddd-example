<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComment\Infrastructure\Persistence;

use CodelyTv\Mooc\VideoComment\Domain\VideoComment;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;

final class VideoCommentRepositoryMySql extends Repository implements VideoCommentRepository
{
    public function save(VideoComment $comment): void
    {
        $this->persist($comment);
    }
}
