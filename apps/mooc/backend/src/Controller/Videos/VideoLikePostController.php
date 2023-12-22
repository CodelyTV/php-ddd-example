<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\Videos;

use CodelyTv\Mooc\VideoLike\Application\Create\CreateVideoLikeCommand;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoLikePostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request): Response
    {
        $command = new CreateVideoLikeCommand(
            messageId: $request->get('messageId'),
            videoLikeId: $request->get('videoLikeId'),
            videoId: $request->get('videoId'),
            userId: $request->get('userId'),
        );

        $this->dispatch($command);

        return new Response('', Response::HTTP_CREATED);
    }
}