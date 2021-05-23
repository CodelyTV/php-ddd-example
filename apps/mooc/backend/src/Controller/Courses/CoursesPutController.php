<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Shared\Infrastructure\Logger\MonologLogger;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CoursesPutController extends ApiController
{



    public function __invoke(string $id, Request $request, Logger $logger): Response
    {
        $this->dispatch(
            new CreateCourseCommand(
                $id,
                $request->request->getAlpha('name'),
                $request->request->getAlpha('duration')
            )
        );

        $loggerMessage = new MonologLogger($logger);
        $loggerMessage->info('Created Course: '.$request->request->getAlpha('name'), 'info');

        return new Response('', Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }
}
