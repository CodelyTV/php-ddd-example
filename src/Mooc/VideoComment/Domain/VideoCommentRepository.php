<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComment\Domain;

interface VideoCommentRepository
{
    public function save(VideoComment $comment): void;
}
