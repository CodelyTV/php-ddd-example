<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\VideoComment\Domain;

interface VideoCommentRepository
{
    public function save(VideoComment $comment): void;
}
