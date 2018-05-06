<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Publish;

use CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish\CourseOpinionPublisher;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish\PublishCourseOpinionCommandHandler;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEventStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionPublishedDomainEventStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionTextStub;
use CodelyTv\Test\Infrastructure\PHPUnit\Module\ModuleUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

final class PublishCourseOpinionTest extends ModuleUnitTestCase
{
    /**
     * @var PublishCourseOpinionCommandHandler
     */
    private $handler;

    /**
     * @var MockInterface
     */
    private $repository;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function it_should_publish_a_course_opinion(): void
    {
        $command = PublishCourseOpinionCommandStub::random();

        $courseId = CourseIdStub::random();
        $id       = CourseOpinionIdStub::create($command->id());
        $rating   = CourseOpinionRatingStub::random();
        $text     = CourseOpinionTextStub::random();

        $opinion = CourseOpinionStub::create($courseId, $id, $rating, $text);

        $domainEventCreated   = CourseOpinionCreatedDomainEventStub::create($courseId, $id, $rating, $text);
        $domainEventPublished = CourseOpinionPublishedDomainEventStub::create($courseId, $id, $rating, $text);

        $this->shouldFindCourseOpinion($opinion);
        $this->shouldSaveCourseOpinion($opinion);
        $this->shouldPublishDomainEvents($domainEventCreated, $domainEventPublished);

        $this->dispatch($command, $this->handler);
    }

    private function shouldFindCourseOpinion(CourseOpinion $opinion): void
    {
        $this->repository()
            ->shouldReceive('findById')
            ->once()
            ->with(similarTo($opinion->id()))
            ->andReturn($opinion);
    }

    /** @return CourseOpinionRepository|MockInterface */
    private function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(CourseOpinionRepository::class);
    }

    private function shouldSaveCourseOpinion(CourseOpinion $opinion): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with(similarTo($opinion))
            ->andReturnNull();
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^The course opinion .* does not exist/
     *
     * @throws \Exception
     */
    public function it_should_not_publish_a_course_opinion_due_course_not_found(): void
    {
        $command = PublishCourseOpinionCommandStub::random();

        $courseId = CourseIdStub::random();
        $id       = CourseOpinionIdStub::create($command->id());
        $rating   = CourseOpinionRatingStub::random();
        $text     = CourseOpinionTextStub::random();

        $opinion = CourseOpinionStub::create($courseId, $id, $rating, $text);

        $this->shouldNotFindCourseOpinion($opinion);

        $this->dispatch($command, $this->handler);
    }

    private function shouldNotFindCourseOpinion(CourseOpinion $opinion): void
    {
        $this->repository()
            ->shouldReceive('findById')
            ->once()
            ->with(similarTo($opinion->id()))
            ->andReturnNull();
    }

    protected function setUp()
    {
        parent::setUp();

        $publisher = new CourseOpinionPublisher(
            $this->repository(),
            $this->domainEventPublisher()
        );

        $this->handler = new PublishCourseOpinionCommandHandler($publisher);
    }
}
