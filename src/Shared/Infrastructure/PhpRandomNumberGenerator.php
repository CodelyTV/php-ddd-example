<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure;

use CodelyTv\Shared\Domain\RandomNumberGenerator;

final class PhpRandomNumberGenerator implements RandomNumberGenerator
{
    public function generate(): int
    {
        $random = random_int(1, 5);

        if ($random > 1) {
            if ($random > 2) {
                if ($random > 3) {
                    if ($random > 4) {
                        return 5;
                    } else {
                        return 4;
                    }
                }
            }
        }

        return $random;
    }
}
