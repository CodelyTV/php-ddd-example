<?php

namespace CodelyTv\Api\Controller\Course;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish\PublishCourseOpinionCommand;
use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Request;

final class CourseOpinionPatchController extends ApiController
{
    public function __invoke(Request $request)
    {
        $command = new PublishCourseOpinionCommand(
            new Uuid($request->get('request_id')),
            $request->get('course_opinion_id')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }

    protected function exceptions(): array
    {
        return [];
    }
}
