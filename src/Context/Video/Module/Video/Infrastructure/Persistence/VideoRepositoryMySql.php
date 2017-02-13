<?php

namespace CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class VideoRepositoryMySql extends Repository implements VideoRepository
{
    public function save(Video $video)
    {
        $this->persist($video);
    }

    public function search(VideoId $id)
    {
        return $this->repository(Video::class)->find($id);
    }
}
