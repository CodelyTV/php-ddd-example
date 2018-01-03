<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

interface VideoRepository
{
    public function save(Video $video): void;

    public function search(VideoId $id): ?Video;
}
