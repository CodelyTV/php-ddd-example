<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Test\Shared\Domain\NumberStub;

final class TotalVideosCreatedStub
{
    public static function create(int $total)
    {
        return new TotalVideosCreated($total);
    }

    public static function random()
    {
        return self::create(NumberStub::lessThan(100));
    }
}
