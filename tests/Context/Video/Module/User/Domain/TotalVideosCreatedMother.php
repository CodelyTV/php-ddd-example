<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Mooc\Module\User\Domain\TotalVideosCreated;
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
