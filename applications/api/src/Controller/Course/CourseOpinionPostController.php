<?php

namespace CodelyTv\Api\Controller\Course;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Create\CreateCourseOpinionCommand;
use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class CourseOpinionPostController extends ApiController
{
    public function __invoke(Request $request)
    {
        $command = new CreateCourseOpinionCommand(
            new Uuid($request->get('request_id')),
            $request->get('course_id'),
            $request->get('id'),
            $request->get('rating'),
            $request->get('text')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }

    protected function exceptions(): array
    {
        return [];
    }
}
