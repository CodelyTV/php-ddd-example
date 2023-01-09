<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Infrastructure\Persistence;

use CodelyTv\Mooc\LastVideo\Domain\LastVideo;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoRepository;
use CodelyTv\Shared\Domain\Utils;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineLastVideoRepository extends DoctrineRepository implements LastVideoRepository
{
    public function save(LastVideo $lastVideo): void
    {
        $this->persist($lastVideo);
    }

    public function search(): ?LastVideo
    {
        return $this->repository(LastVideo::class)->findOneBy([]);
    }
}
