<?php

namespace CodelyTv\Context\Meetup\Module\Video\Tests\Behaviour;

use CodelyTv\Context\Meetup\Module\Video\Domain\Create\CreateVideoCommandHandler;
use CodelyTv\Context\Meetup\Module\Video\Domain\Create\VideoCreator;
use CodelyTv\Context\Meetup\Module\Video\Test\PhpUnit\VideoModuleUnitTestCase;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\CreateVideoCommandStub;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\VideoCreatedDomainEventStub;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\VideoIdStub;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\VideoStub;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\VideoTitleStub;
use CodelyTv\Context\Meetup\Module\Video\Test\Stub\VideoUrlStub;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

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
        $title    = VideoTitleStub::create($command->title());
        $url      = VideoUrlStub::create($command->url());
        $courseId = CourseIdStub::create($command->courseId());

        $video = VideoStub::create($id, $title, $url, $courseId);

        $domainEvent = VideoCreatedDomainEventStub::create($id, $title, $url, $courseId);

        $this->shouldSaveVideo($video);
        $this->shouldPublishDomainEvents([$domainEvent]);

        $this->dispatch($command, $this->handler);
    }
}
