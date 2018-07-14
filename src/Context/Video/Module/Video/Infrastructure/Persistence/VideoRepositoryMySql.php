<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Module\Video\Domain\Videos;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;
use CodelyTv\Shared\Domain\CourseId;

final class VideoRepositoryMySql extends Repository implements VideoRepository
{
    public function save(Video $video): void
    {
        $this->persist($video);
    }

    public function search(VideoId $id): ?Video
    {
        return $this->repository(Video::class)->find($id);
    }

    public function searchByCourseId(CourseId $courseId): Videos
    {
        return new Videos($this->repository(Video::class)->findBy(['course_id' => $courseId]));
    }
}
