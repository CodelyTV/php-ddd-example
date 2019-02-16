<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\User\Domain;

use CodelyTv\Mooc\User\Domain\TotalVideosCreated;
use CodelyTv\Test\Shared\Domain\NumberMother;

final class TotalVideosCreatedMother
{
    public static function create(int $total)
    {
        return new TotalVideosCreated($total);
    }

    public static function random()
    {
        return self::create(NumberMother::lessThan(100));
    }
}
