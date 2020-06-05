<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\Create\CreateCourseCommand;
use CodelyTv\Mooc\Courses\Application\Update\CourseRenamerCommand;
use CodelyTv\Shared\Infrastructure\PatchParser;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use mikemccabe\JsonPatch\JsonPatch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class CoursesPatchController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $id, Request $request): Response
    {
        $patches = JsonPatch::get(json_decode($request->getContent(), true), '');

        $supportedPatches = [
            [
                'query' => [
                    'op' => 'replace',
                    'path' => '/name',
                    'value' => '/value'
                ],
                'execution' => function($id, $value): bool {
                    $this->dispatch(
                        new CourseRenamerCommand(
                            $id,
                            $value
                        )
                    );
                    return true;
                },
                'failure' => function(): bool {
                    return false;
                }
            ]
        ];

        foreach ($patches as $patch) {
            $execution = PatchParser::parse($patch, $supportedPatches);
            if ($execution === null) {
                return new Response('Operation not supported', Response::HTTP_BAD_REQUEST);
            }

            $execution($id);
        }

        return new Response('', Response::HTTP_OK);
    }
}
