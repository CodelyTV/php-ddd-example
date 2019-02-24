<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Infrastructure\Persistence;

use CodelyTv\Mooc\Video\Domain\Video;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Mooc\Video\Domain\Videos;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;
use CodelyTv\Shared\Domain\Criteria\Criteria;

final class VideoRepositoryMySql extends DoctrineRepository implements VideoRepository
{
    private static $criteriaToDoctrineFields = [
        'id'        => 'id',
        'type'      => 'type',
        'title'     => 'title',
        'url'       => 'url',
        'course_id' => 'courseId',
    ];

    public function save(Video $video): void
    {
        $this->persist($video);
    }

    public function search(VideoId $id): ?Video
    {
        return $this->repository(Video::class)->find($id);
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, self::$criteriaToDoctrineFields);
        $videos           = $this->repository(Video::class)->matching($doctrineCriteria)->toArray();

        return new Videos($videos);
    }
}
