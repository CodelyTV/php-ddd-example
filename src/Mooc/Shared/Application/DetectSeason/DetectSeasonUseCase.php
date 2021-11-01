<?php

namespace CodelyTv\Mooc\Shared\Application\DetectSeason;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterResponse;
use CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;
use CodelyTv\Mooc\Shared\Domain\Clock\FallSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\SpringSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\SummerSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\WinterSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\Season;

class DetectSeasonUseCase
{
    private ClockInterface $clock;

    public function __construct(ClockInterface $clock)
    {
        $this->clock = $clock;
    }

    public function __invoke(): DetectSeasonResponse
    {
        $response = new DetectSeasonResponse();
        $date = $this->clock->getDate();
        $seasons = [new FallSeason(), new SpringSeason(), new WinterSeason(), new SummerSeason()];

        /** @var Season $season */
        foreach ($seasons as $season)
        {
            if ($season->isDateInSeason($date))
            {
                return $response->setSeason($season);
            }
        }

        throw new \Exception('Your date is not in any season. Impossible case!!');
    }
}