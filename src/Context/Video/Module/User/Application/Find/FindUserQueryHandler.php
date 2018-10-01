<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\Find;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindUserQueryHandler implements QueryHandler
{
    private $finder;

    public function __construct(UserFinder $finder)
    {
        $this->finder = pipe($finder, new UserResponseConverter());
    }

    public function __invoke(FindUserQuery $query): UserResponse
    {
        $id = new UserId($query->id());

        return apply($this->finder, [$id]);
    }
}
