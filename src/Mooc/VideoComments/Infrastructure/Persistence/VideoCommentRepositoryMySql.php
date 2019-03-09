<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Infrastructure\Persistence;

use CodelyTv\Mooc\VideoComments\Domain\VideoComment;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class VideoCommentRepositoryMySql extends DoctrineRepository implements VideoCommentRepository
{
    public function save(VideoComment $comment): void
    {
        $this->persist($comment);
    }
}
