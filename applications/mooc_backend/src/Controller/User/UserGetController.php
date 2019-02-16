<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\User;

use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Mooc\Module\User\Application\Find\FindUserQuery;
use CodelyTv\Mooc\Module\User\Domain\UserNotExist;
use Symfony\Component\HttpFoundation\Response;

final class UserGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [
            UserNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }

    public function __invoke(string $id)
    {
        return $this->ask(new FindUserQuery($id));
    }
}
