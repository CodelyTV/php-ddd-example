<?php

namespace CodelyTv\Test\Shared\Utils;

use DateTimeImmutable;
use CodelyTv\Test\Infrastructure\PHPUnit\UnitTestCase;
use CodelyTv\Test\Shared\Domain\DateTimeStub;
use CodelyTv\Test\Shared\Domain\DateTimeZoneStub;
use function CodelyTv\Utils\date_to_string;
use function CodelyTv\Utils\string_to_date;

final class DateTransformationTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider validDatesConversions
     */
    public function it_should_convert_a_date_to_milliseconds(DateTimeImmutable $date, string $expected)
    {
        $this->assertSame($expected, date_to_string($date));
    }

    /**
     * @test
     * @dataProvider validDatesConversions
     */
    public function it_should_convert_a_date_from_milliseconds(DateTimeImmutable $expected, string $stringDate)
    {
        $this->assertEquals($expected, string_to_date($stringDate));
    }

    public function validDatesConversions()
    {
        return [
            [
                'date'   => DateTimeStub::create('1993-06-26 10:00:00 GMT+0200'),
                'string' => '741081600000',
            ],
            [
                'date'   => DateTimeStub::create('1994-09-29 15:00:00 GMT+0200'),
                'string' => '780843600000',
            ],

            [
                'date'   => DateTimeStub::create('2020-01-15 22:23:24 GMT+0500'),
                'string' => '1579109004000',
            ],
            [
                'date'   => DateTimeStub::create('2016-10-03 12:41:32.980000', DateTimeZoneStub::UTC()),
                'string' => '1475498492980',
            ],
        ];
    }
}
