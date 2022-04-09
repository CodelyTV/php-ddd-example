<?php

namespace CodelyTv\Mooc\Shared\Application\DetectSeason;

use CodelyTv\Mooc\Shared\Domain\Clock\Season;
use CodelyTv\Shared\Domain\Bus\Query\Response;

class DetectSeasonResponse implements Response
{
    public function setSeason(Season $season)
    {
        $this->season = $season;
    }

    public function season(): Season
    {
        return $this->season;
    }
}