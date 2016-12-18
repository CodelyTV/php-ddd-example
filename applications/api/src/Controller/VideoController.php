<?php

namespace CodelyTv\Api\Controller;

use CodelyTv\Context\Video\Module\Video\Domain\Create\CreateVideoCommand;
use CodelyTv\Infrastructure\Bus\Command\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VideoController extends Controller
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function createAction(string $id, Request $request)
    {
        $command = new CreateVideoCommand(
            $id,
            $request->get('title'),
            $request->get('url'),
            $request->get('course_id')
        );

        $this->bus->dispatch($command);

        return new Response('', Response::HTTP_CREATED);
    }
}
