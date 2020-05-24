<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class CoursesPutController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $id, Request $request): Response
    {
        $this->dispatch(
            new CreateCourseCommand(
                $id,
                $request->request->get('name'),
                $request->request->get('duration')
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }
}
