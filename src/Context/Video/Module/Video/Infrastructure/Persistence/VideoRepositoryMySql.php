<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Video\Domain\Video;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Video\Module\Video\Domain\Videos;
use CodelyTv\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use CodelyTv\Infrastructure\Doctrine\Repository;
use CodelyTv\Shared\Domain\Criteria\Criteria;

final class VideoRepositoryMySql extends Repository implements VideoRepository
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
