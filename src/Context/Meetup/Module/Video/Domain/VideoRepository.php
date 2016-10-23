<?php

namespace CodelyTv\Context\Meetup\Module\Video\Domain;

interface VideoRepository
{
    /** @return void */
    public function save(Video $video);
}
