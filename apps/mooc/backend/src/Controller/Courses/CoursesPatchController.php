<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
//use CodelyTv\Mooc\Courses\Application\Update\CourseRenamer;
//use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommand;
use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommand;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use mikemccabe\JsonPatch\JsonPatch;

final class CoursesPatchController
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(string $id, Request $request)
    {
        $franca = null;
        try {
            $franca = JsonPatch::get($request->request->all(), '/patch/0');
        } catch (\Throwable $e) {
            die($e->getMessage());
        }

        $this->bus->dispatch(
            new CourseRenamerCommand($id, 'aaaa')
        );

        //todo continue here -> querybus in order to get new renamed Course and return it

        return new Response('', Response::HTTP_CREATED);

    }

    private function patchOperatorFactory(array $patchOperation): ?callable {
//        if $patchOperation['path'] == '/'
    }
}
