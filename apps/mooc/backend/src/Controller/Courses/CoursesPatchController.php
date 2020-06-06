<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommand;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use CodelyTv\Shared\Infrastructure\PatchParser;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use CodelyTv\Shared\Infrastructure\Symfony\ApiExceptionsHttpStatusCodeMapping;
use mikemccabe\JsonPatch\JsonPatch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CoursesPatchController extends ApiController
{
    private array $supportedPatches;

    public function __construct(QueryBus $queryBus, CommandBus $commandBus, ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        parent::__construct($queryBus, $commandBus, $exceptionHandler);

        // todo a class defining this patch handling structure, probably into a shared/infrastructure for reuse
        $this->supportedPatches =  [
            [
                PatchParser::QUERY_SECTION_KEY => [
                    PatchParser::OP_KEY     => 'replace',
                    PatchParser::PATH_KEY   => '/name',
                    PatchParser::VALUE_KEY  => '/.*/'
                ],
                PatchParser::EXECUTION_SECTION_KEY => function($id, $value): bool {
                    $this->dispatch(
                        new CourseRenamerCommand(
                            $id,
                            $value
                        )
                    );
                    return true;
                }
            ]
        ];
    }

    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $id, Request $request): Response
    {
        $patches = JsonPatch::get(json_decode($request->getContent(), true), '');

        foreach ($patches as $patch) {
            $execution = PatchParser::parse($patch, $this->supportedPatches);
            if ($execution === null) {
                return new Response(
                    'One of the specified patch is not supported',
                    Response::HTTP_BAD_REQUEST
                );
            }

            $execution($id);
        }

        return new Response('', Response::HTTP_OK);
    }
}
