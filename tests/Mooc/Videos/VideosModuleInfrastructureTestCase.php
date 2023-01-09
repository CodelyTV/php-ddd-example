<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos;

use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class VideosModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
    protected function repository(): VideoRepository
    {
        return $this->service(VideoRepository::class);
    }
}
