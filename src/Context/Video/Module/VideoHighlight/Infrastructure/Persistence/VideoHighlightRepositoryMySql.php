<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlight;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

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
