<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlights\Infrastructure\Persistence;

use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlight;
use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightId;
use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class VideoHighlightRepositoryMySql extends DoctrineRepository implements VideoHighlightRepository
{
    public function save(VideoHighlight $videoHighlight): void
    {
        $this->persist($videoHighlight);
    }

    public function search(VideoHighlightId $id): ?VideoHighlight
    {
        return $this->repository(VideoHighlight::class)->find($id);
    }
}
