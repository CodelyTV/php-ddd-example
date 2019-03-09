<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class FunctionalTestCase extends KernelTestCase
{
    protected function setUp()
    {
        self::bootKernel(['environment' => 'test']);

        parent::setUp();
    }

    protected function service($id)
    {
        return self::$container->get($id);
    }

    protected function parameter($parameter)
    {
        return self::$container->getParameter($parameter);
    }
}
