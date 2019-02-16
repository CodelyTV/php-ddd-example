<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\User;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Mooc\User\Domain\UserRepository;
use CodelyTv\Test\Mooc\Module\User\Domain\UserMother;
use function Lambdish\Phunctional\apply;

final class UserModuleBehatContext extends RawMinkContext implements Context
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Given /^there is a user:$/
     */
    public function thereIsAUser(TableNode $table)
    {
        apply($this->creator(), [$table->getRowsHash()]);
    }

    private function creator()
    {
        return function (array $user) {
            $this->repository->save(UserMother::withValues($user['id'], $user['name'], (int) $user['total_pending_videos']));
        };
    }
}
