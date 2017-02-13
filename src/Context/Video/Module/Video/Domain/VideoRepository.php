<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

interface VideoRepository
{
    /** @return void */
    public function save(Video $video);

    /** @return Video|null */
    public function search(VideoId $id);
}
