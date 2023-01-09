<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Videos;

use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VideosPutController extends ApiController
{
    public function __invoke(string $id, Request $request): Response
    {
        $this->dispatch(
            new CreateVideoCommand(
                $id,
                (string) $request->request->get('type'),
                (string) $request->request->get('title'),
                (string) $request->request->get('url'),
                (string) $request->request->get('courseId')
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
