<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Create;

use CodelyTv\Context\Course\Module\CourseOpinion\Application\Create\CourseOpinionCreator;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Create\CreateCourseOpinionCommandHandler;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEventStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionTextStub;
use CodelyTv\Test\Infrastructure\PHPUnit\Module\ModuleUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

final class CreateCourseOpinionTest extends ModuleUnitTestCase
{
    /**
     * @var CreateCourseOpinionCommandHandler
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
    public function it_should_create_a_course_opinion(): void
    {
        $command = CreateCourseOpinionCommandStub::random();

        $courseId = CourseIdStub::create($command->courseId());
        $id       = CourseOpinionIdStub::create($command->id());
        $rating   = CourseOpinionRatingStub::create($command->rating());
        $text     = CourseOpinionTextStub::create($command->text());

        $opinion = CourseOpinionStub::create($courseId, $id, $rating, $text);

        $domainEvent = CourseOpinionCreatedDomainEventStub::create($courseId, $id, $rating, $text);

        $this->shouldSaveCourseOpinion($opinion);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    private function shouldSaveCourseOpinion(CourseOpinion $opinion): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with(similarTo($opinion))
            ->andReturnNull();
    }

    /** @return CourseOpinionRepository|MockInterface */
    private function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(CourseOpinionRepository::class);
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The rating cannot be a decimal
     *
     * @throws \Exception
     */
    public function it_should_not_create_a_course_opinion_due_to_decimal_rating(): void
    {
        $command = CreateCourseOpinionCommandStub::randomWithDecimalRating();

        $this->dispatch($command, $this->handler);
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The minimum rating for an opinion is 0
     *
     * @throws \Exception
     */
    public function it_should_not_create_a_course_opinion_due_to_rating_below_limit(): void
    {
        $command = CreateCourseOpinionCommandStub::randomWithRatingBelow0();

        $this->dispatch($command, $this->handler);
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The maximum rating for an opinion is 5
     *
     * @throws \Exception
     */
    public function it_should_not_create_a_course_opinion_due_to_rating_above_limit(): void
    {
        $command = CreateCourseOpinionCommandStub::randomWithRatingAbove5();

        $this->dispatch($command, $this->handler);
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The max length for a comment is 300
     *
     * @throws \Exception
     */
    public function it_should_not_create_a_course_opinion_due_to_text_above_limit(): void
    {
        $command = CreateCourseOpinionCommandStub::randomWithLongerText();

        $this->dispatch($command, $this->handler);
    }

    protected function setUp()
    {
        parent::setUp();

        $creator = new CourseOpinionCreator(
            $this->repository(),
            $this->domainEventPublisher()
        );

        $this->handler = new CreateCourseOpinionCommandHandler($creator);
    }
}
