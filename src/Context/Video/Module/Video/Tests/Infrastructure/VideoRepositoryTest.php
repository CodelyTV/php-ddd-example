<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Tests\Infrastructure;

use CodelyTv\Context\Video\Module\Video\Test\PhpUnit\VideoModuleFunctionalTestCase;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoStub;

final class VideoRepositoryTest extends VideoModuleFunctionalTestCase
{
    /** @test */
    public function it_should_save_a_video()
    {
        $this->repository()->save(VideoStub::random());
    }

    /** @test */
    public function it_should_search_a_video()
    {
        $videoToSave = VideoStub::random();

        $this->repository()->save($videoToSave);

        $this->clearUnitOfWork();

        $savedVideo = $this->repository()->search($videoToSave->id());

        $this->assertSimilar($videoToSave, $savedVideo);
    }
}
