<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Student;

use CodelyTv\Mooc\Students\Application\Find\FindStudentQuery;
use CodelyTv\Mooc\Students\Domain\StudentNotExist;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class StudentGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [
            StudentNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }

    public function __invoke(string $id)
    {
        return $this->ask(new FindStudentQuery($id));
    }
}
