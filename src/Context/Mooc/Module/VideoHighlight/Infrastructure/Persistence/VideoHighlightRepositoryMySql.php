<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\VideoHighlight\Infrastructure\Persistence;

use CodelyTv\Context\Mooc\Module\VideoHighlight\Domain\VideoHighlight;
use CodelyTv\Context\Mooc\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Context\Mooc\Module\VideoHighlight\Domain\VideoHighlightRepository;
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
