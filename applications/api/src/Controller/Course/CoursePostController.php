<?php

namespace CodelyTv\Api\Controller\Course;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Course\Module\Course\Application\Create\CreateCourseCommand;
use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class CoursePostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        $command = new CreateCourseCommand(
            new Uuid($request->get('request_id')),
            $request->get('id'),
            $request->get('title'),
            $request->get('description')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}
