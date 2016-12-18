<?php

namespace CodelyTv\Api\Controller\Video;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Api\Infrastructure\Response\ApiHttpCreatedResponse;
use CodelyTv\Context\Video\Module\Video\Domain\Create\CreateVideoCommand;
use Symfony\Component\HttpFoundation\Request;

final class VideoPostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        $command = new CreateVideoCommand(
            $request->get('id'),
            $request->get('title'),
            $request->get('url'),
            $request->get('course_id')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}
