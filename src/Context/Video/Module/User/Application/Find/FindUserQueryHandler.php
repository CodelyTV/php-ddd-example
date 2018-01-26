<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Application\Find;

use CodelyTv\Context\Video\Module\User\Application\UserResponseConverter;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\pipe;

final class FindUserQueryHandler
{
    private $finder;

    public function __construct(UserFinder $finder)
    {
        $this->finder = pipe($finder, new UserResponseConverter());
    }

    public function __invoke(FindUserQuery $query)
    {
        $id = new UserId($query->id());

        return apply($this->finder, [$id]);
    }
}
