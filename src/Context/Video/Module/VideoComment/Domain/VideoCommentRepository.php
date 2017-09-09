<?php

namespace CodelyTv\Context\Video\Module\VideoComment\Domain;

interface VideoCommentRepository
{
    /** @return void */
    public function save(VideoComment $comment);
}
