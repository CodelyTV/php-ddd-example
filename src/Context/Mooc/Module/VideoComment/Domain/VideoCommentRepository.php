<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\VideoComment\Domain;

interface VideoCommentRepository
{
    public function save(VideoComment $comment): void;
}
