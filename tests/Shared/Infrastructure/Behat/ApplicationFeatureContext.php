<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Cassandra\Duration;
use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Infrastructure\Persistence\DoctrineCourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Infrastructure\Bus\Event\DomainEventJsonDeserializer;
use CodelyTv\Shared\Infrastructure\Bus\Event\InMemory\InMemorySymfonyEventBus;
use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseConnections;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use RuntimeException;

final class ApplicationFeatureContext implements Context
{
    private $connections;
    private $bus;
    private $deserializer;
    private CommandBus $commandBus;
    private DoctrineCourseRepository $repository;

    public function __construct(
        DatabaseConnections $connections,
        InMemorySymfonyEventBus $bus,
        DomainEventJsonDeserializer $deserializer,
        CommandBus $commandBus,
        DoctrineCourseRepository $repository
    ) {
        $this->connections  = $connections;
        $this->bus          = $bus;
        $this->deserializer = $deserializer;
        $this->commandBus   = $commandBus;
        $this->repository   = $repository;
    }

    /** @BeforeScenario */
    public function cleanEnvironment(): void
    {
        $this->connections->clear();
        $this->connections->truncate();
    }

    /**
     * @Given /^I send an event to the event bus:$/
     */
    public function iSendAnEventToTheEventBus(PyStringNode $event)
    {
        $domainEvent = $this->deserializer->deserialize($event->getRaw());

        $this->bus->publish($domainEvent);
    }

    /**
     * @Given /^I send an event to the command bus:$/
     */
    public function iSendAnEventToTheCommandBus($id, $name, $duration)
    {
        $this->commandBus->dispatch(
            new CreateCourseCommand(
                $id,
                $name('name'),
                $duration
            )
        );
    }

    /**
     * @Given A course with id :arg1 and title :arg2 and duration of :arg3
     */
    public function aCourseWithIdAndTitleAndDurationOf($givenCourseId, $givenCourseName, $givenCourseDuration)
    {
        $courseToSave = new Course(
            new CourseId($givenCourseId),
            new CourseName($givenCourseName),
            new CourseDuration($givenCourseDuration)
        );
        $this->repository->save($courseToSave);
    }

    /**
     * @Given the course with id :courseId has a title :courseTitle
     */
    public function theCourseWithIdHasATitle($givenCourseId, $expectedCourseTitle)
    {
        $this->connections->clear();
        $course = $this->repository->search(CourseIdMother::create($givenCourseId));

        if ($expectedCourseTitle !== $course->name()->value()) {
            throw new RuntimeException(
                sprintf(
                    'The name <%s> does not match the expected <%s>',
                    $course->name(),
                    $expectedCourseTitle
                )
            );
        }
    }
}
