<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Application\Find;

use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindStudentQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(StudentFinder $finder)
    {
        $this->finder = pipe($finder, new StudentResponseConverter());
    }

    public function __invoke(FindStudentQuery $query): StudentResponse
    {
        $id = new StudentId($query->id());

        return apply($this->finder, [$id]);
    }
}
