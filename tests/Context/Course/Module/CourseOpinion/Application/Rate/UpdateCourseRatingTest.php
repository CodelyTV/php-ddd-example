<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\Course\Domain\Repository\CourseRepository;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate\CourseRatingUpdater;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate\UpdateCourseRatingCommandHandler;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Entity\CourseStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event\CourseCreatedDomainEventStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event\CourseRatingUpdatedDomainEventStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseDescriptionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseTitleStub;
use CodelyTv\Test\Infrastructure\PHPUnit\Module\ModuleUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

final class UpdateCourseRatingTest extends ModuleUnitTestCase
{
    /**
     * @var UpdateCourseRatingCommandHandler
     */
    private $handler;

    /**
     * @var MockInterface
     */
    private $courseRepository;

    /**
     * @var MockInterface
     */
    private $courseOpinionRepository;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function it_should_rate_a_course(): void
    {
        $command = UpdateCourseRatingCommandStub::random();

        $id          = CourseIdStub::create($command->id());
        $title       = CourseTitleStub::random();
        $description = CourseDescriptionStub::random();
        $rating      = CourseRatingStub::random();

        $course = CourseStub::create($id, $title, $description);

        $domainEventCreated = CourseCreatedDomainEventStub::create($id, $title, $description);
        $domainEventUpdated = CourseRatingUpdatedDomainEventStub::create($id, $title, $description, $rating);

        $this->shouldPublishDomainEvents($domainEventCreated, $domainEventUpdated);
        $this->shouldFindCourse($course);
        $this->shouldGetRatingForCourse($course);
        $this->shouldSaveCourse($course);

        $this->dispatch($command, $this->handler);
    }

    private function shouldFindCourse(Course $course): void
    {
        $this->courseRepository()
            ->shouldReceive('findById')
            ->once()
            ->with(similarTo($course->id()))
            ->andReturn($course);
    }

    /** @return CourseRepository|MockInterface */
    private function courseRepository()
    {
        return $this->courseRepository = $this->courseRepository ?: $this->mock(CourseRepository::class);
    }

    private function shouldGetRatingForCourse(Course $course): void
    {
        $this->courseOpinionRepository()
            ->shouldReceive('getRating')
            ->once()
            ->with(similarTo($course))
            ->andReturn(
                CourseRatingStub::random()
            );
    }

    /** @return CourseOpinionRepository|MockInterface */
    private function courseOpinionRepository()
    {
        return $this->courseOpinionRepository = $this->courseOpinionRepository ?: $this->mock(CourseOpinionRepository::class);
    }

    private function shouldSaveCourse(Course $course): void
    {
        $this->courseRepository()
            ->shouldReceive('save')
            ->once()
            ->with(similarTo($course))
            ->andReturnNull();
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^The course .* does not exist/
     *
     * @throws \Exception
     */
    public function it_should_not_rate_a_course_due_course_not_found(): void
    {
        $command = UpdateCourseRatingCommandStub::random();

        $id          = CourseIdStub::create($command->id());
        $title       = CourseTitleStub::random();
        $description = CourseDescriptionStub::random();

        $course = CourseStub::create($id, $title, $description);

        $this->shouldNotFindCourse($course);

        $this->dispatch($command, $this->handler);
    }

    private function shouldNotFindCourse(Course $course): void
    {
        $this->courseRepository()
            ->shouldReceive('findById')
            ->once()
            ->with(similarTo($course->id()))
            ->andReturnNull();
    }

    protected function setUp()
    {
        parent::setUp();

        $updater = new CourseRatingUpdater(
            $this->courseRepository(),
            $this->courseOpinionRepository(),
            $this->domainEventPublisher()
        );

        $this->handler = new UpdateCourseRatingCommandHandler($updater);
    }
}
