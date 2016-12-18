<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

interface VideoRepository
{
    /** @return void */
    public function save(Video $video);
}
