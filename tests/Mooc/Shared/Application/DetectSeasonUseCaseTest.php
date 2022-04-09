<?php

namespace CodelyTv\Tests\Mooc\Shared\Application;

use CodelyTv\Mooc\Shared\Application\DetectSeason\DetectSeasonUseCase;
use CodelyTv\Mooc\Shared\Domain\Clock\ClockInterface;
use CodelyTv\Mooc\Shared\Domain\Clock\FallSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\SpringSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\SummerSeason;
use CodelyTv\Mooc\Shared\Domain\Clock\WinterSeason;
use CodelyTv\Tests\Mooc\Shared\Domain\SeasonMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;

class DetectSeasonUseCaseTest extends UnitTestCase
{
    public function provider_it_detects_season()
    {
        return [
            'detects_summer_correctly' => [SeasonMother::randomSummer(), SummerSeason::class],
            'detects_fall_correctly' => [SeasonMother::randomFall(), FallSeason::class],
            'detects_spring_correctly' => [SeasonMother::randomSpring(), SpringSeason::class],
            'detects_winter_correctly' => [SeasonMother::randomWinter(), WinterSeason::class],
            'detects_winter_correctly_when_29_feb' => [SeasonMother::leapYearDate(), WinterSeason::class],
        ];
    }

    /**
     * @dataProvider provider_it_detects_season
     * @test
     */
    public function it_detects_season(ClockInterface $clock, string $expectedClass): void
    {
        $useCase = new DetectSeasonUseCase($clock);
        $response = $useCase();
        self::assertInstanceOf($expectedClass, $response->season());
    }
}