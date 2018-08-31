<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepositoryLast;
use CodelyTv\Infrastructure\Doctrine\Repository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

final class VideoRepositoryMySql extends Repository implements VideoRepository, VideoRepositoryLast
{
    public function save(Video $video): void
    {
        $this->persist($video);
    }

    public function search(VideoId $id): ?Video
    {
        return $this->repository(Video::class)->find($id);
    }

    public function searchLast(): ?Video
    {
        $lastVideo = null;

        try {
            $lastVideo = $this->repository(Video::class)
                ->createQueryBuilder('video')
                ->setMaxResults(1)
                ->orderBy('video.id', 'DESC')
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {

        } catch (NonUniqueResultException $e) {

        }

        return $lastVideo;
    }
}
