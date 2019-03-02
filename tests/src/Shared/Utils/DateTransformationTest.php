<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Utils;

use CodelyTv\Test\Shared\Domain\DateTimeMother;
use CodelyTv\Test\Shared\Domain\DateTimeZoneMother;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;
use DateTimeImmutable;
use function CodelyTv\Utils\Shared\date_to_string;
use function CodelyTv\Utils\Shared\string_to_date;

final class DateTransformationTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider validDatesConversions
     */
    public function it_should_convert_a_date_to_milliseconds(DateTimeImmutable $date, string $expected): void
    {
        $this->assertSame($expected, date_to_string($date));
    }

    /**
     * @test
     * @dataProvider validDatesConversions
     */
    public function it_should_convert_a_date_from_milliseconds(DateTimeImmutable $expected, string $stringDate): void
    {
        $this->assertEquals($expected, string_to_date($stringDate));
    }

    public function validDatesConversions(): array
    {
        return [
            [
                'date'   => DateTimeMother::create('1993-06-26 10:00:00 GMT+0200'),
                'string' => '741081600000',
            ],
            [
                'date'   => DateTimeMother::create('1994-09-29 15:00:00 GMT+0200'),
                'string' => '780843600000',
            ],

            [
                'date'   => DateTimeMother::create('2020-01-15 22:23:24 GMT+0500'),
                'string' => '1579109004000',
            ],
            [
                'date'   => DateTimeMother::create('2016-10-03 12:41:32.980000', DateTimeZoneMother::UTC()),
                'string' => '1475498492980',
            ],
        ];
    }
}
