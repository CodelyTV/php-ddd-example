<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students;

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Mooc\Students\Domain\StudentRepository;
use CodelyTv\Test\Mooc\Students\Domain\StudentMother;
use function Lambdish\Phunctional\apply;

final class StudentModuleBehatContext extends RawMinkContext
{
    private $repository;

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Given /^there is an student:$/
     */
    public function thereIsAnStudent(TableNode $table): void
    {
        apply($this->creator(), [$table->getRowsHash()]);
    }

    private function creator(): callable
    {
        return function (array $student) {
            $this->repository->save(
                StudentMother::withValues($student['id'], $student['name'], (int) $student['total_pending_videos'])
            );
        };
    }
}
