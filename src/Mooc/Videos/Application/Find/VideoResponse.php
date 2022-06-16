<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class VideoResponse implements Response
{
    public function __construct(
        private readonly string $id,
        private readonly string $type,
        private readonly string $title,
        private readonly string $url,
        private readonly string $courseId
    ) {
    }
}
