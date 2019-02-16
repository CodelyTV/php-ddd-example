<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\VideoHighlight\Domain;

interface VideoHighlightRepository
{
    /** @return void */
    public function save(VideoHighlight $videoHighlight);

    /** @return VideoHighlight|null */
    public function search(VideoHighlightId $id);
}
