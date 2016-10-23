<?php

namespace CodelyTv\Context\Meetup\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Meetup\Module\Video\Domain\Video;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class VideoRepositoryMySql extends Repository implements VideoRepository
{
    public function save(Video $video)
    {
        $this->persist($video);
    }
}
