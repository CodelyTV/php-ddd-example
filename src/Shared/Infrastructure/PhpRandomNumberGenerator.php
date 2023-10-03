<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure;

use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Shared\Domain\RandomNumberGenerator;

final class PhpRandomNumberGenerator implements RandomNumberGenerator
{
    public function generate(): int
    {
        $uuid = new VideoTitle('test');

        return random_int(1, 5);
    }
}
