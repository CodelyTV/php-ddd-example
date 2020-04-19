<?php

namespace CodelyTv\Tests\Backoffice\Videos\Domain;

use CodelyTv\Backoffice\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use InvalidArgumentException;

class VideoTitleTest extends UnitTestCase
{
    /** @test */
    public function should_fail_when_title_value_is_empty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("title should not be empty");
        new VideoTitle("");
    }
}