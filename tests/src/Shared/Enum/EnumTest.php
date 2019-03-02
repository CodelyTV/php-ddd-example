<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Enum;

use CodelyTv\Test\Shared\Infrastructure\PHPUnit\UnitTestCase;

final class EnumTest extends UnitTestCase
{
    /** @test */
    public function it_should_be_able_to_construct_enums_with_strings_inside(): void
    {
        $this->assertEquals('one', StringTestEnum::one()->value());
        $this->assertEquals('two', StringTestEnum::two()->value());
        $this->assertEquals('A very large number', StringTestEnum::aVeryLargeNumber()->value());
    }

    /** @test */
    public function it_should_be_able_to_construct_enums_with_numbers_inside(): void
    {
        $this->assertEquals(1, NumberTestEnum::one()->value());
        $this->assertEquals(2, NumberTestEnum::two()->value());
    }
}
