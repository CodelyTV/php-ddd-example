<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLike;
use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLikeId;
use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLikeRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class VideoLikeRepositoryMySql extends Repository implements VideoLikeRepository
{
    public function save(VideoLike $video)
    {
        $this->persist($video);
    }

    public function search(VideoLikeId $id)
    {
        return $this->repository(VideoLike::class)->find($id);
    }
}
