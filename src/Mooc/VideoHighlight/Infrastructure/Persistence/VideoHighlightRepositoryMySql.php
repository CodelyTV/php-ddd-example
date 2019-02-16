<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlight\Infrastructure\Persistence;

use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlight;
use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlightRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;

final class VideoHighlightRepositoryMySql extends Repository implements VideoHighlightRepository
{
    /** @return void */
    public function save(VideoHighlight $videoHighlight)
    {
        $this->persist($videoHighlight);
    }

    public function search(VideoHighlightId $id)
    {
        return $this->repository(VideoHighlight::class)->find($id);
    }
}
