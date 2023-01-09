<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\Persistence;

use CodelyTv\Tests\Mooc\Videos\VideosModuleInfrastructureTestCase;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;

final class VideoRepositoryTest extends VideosModuleInfrastructureTestCase
{
    /** @test */
    public function it_should_save_a_Video(): void
    {
        $Video = VideoMother::create();

        $this->repository()->save($Video);
    }

    /** @test */
    public function it_should_return_an_existing_Video(): void
    {
        $Video = VideoMother::create();

        $this->repository()->save($Video);

        $this->assertEquals($Video, $this->repository()->search($Video->id()));
    }

    /** @test */
    public function it_should_not_return_a_non_existing_video(): void
    {
        $this->assertNull($this->repository()->search(VideoIdMother::create()));
    }
}
