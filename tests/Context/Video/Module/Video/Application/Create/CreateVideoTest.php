<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Create;

use CodelyTv\Context\Video\Module\Video\Application\Create\CreateVideoCommandHandler;
use CodelyTv\Context\Video\Module\Video\Application\Create\VideoCreator;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoCreatedDomainEventStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTitleStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoTypeStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoUrlStub;
use CodelyTv\Test\Context\Video\Module\Video\VideoModuleUnitTestCase;

final class CreateVideoTest extends VideoModuleUnitTestCase
{
    /** @var CreateVideoCommandHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $creator = new VideoCreator($this->repository(), $this->domainEventPublisher());

        $this->handler = new CreateVideoCommandHandler($creator);
    }

    /** @test */
    public function it_should_create_a_video()
    {
        $command = CreateVideoCommandStub::random();

        $id       = VideoIdStub::create($command->id());
        $type     = VideoTypeStub::create($command->type());
        $title    = VideoTitleStub::create($command->title());
        $url      = VideoUrlStub::create($command->url());
        $courseId = CourseIdStub::create($command->courseId());

        $video = VideoStub::create($id, $type, $title, $url, $courseId);

        $domainEvent = VideoCreatedDomainEventStub::create($id, $type, $title, $url, $courseId);

        $this->shouldSaveVideo($video);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}
