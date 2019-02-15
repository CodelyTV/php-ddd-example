<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\PHPUnit;

use CodelyTv\CodelyKernel;
use CodelyTv\MoocBackend\MoocBackendKernel;

abstract class FunctionalTestCase extends UnitTestCase
{
    /** @var MoocBackendKernel */
    private $kernel;

    protected function setUp()
    {
        parent::setUp();

        $this->kernel()->boot();
    }

    protected function service($id)
    {
        return $this->container()->get($id);
    }

    protected function parameter($parameter)
    {
        return $this->container()->getParameter($parameter);
    }

    private function kernel()
    {
        return $this->kernel = $this->kernel ?: new CodelyKernel('test', true);
    }

    private function container()
    {
        return $this->kernel()->getContainer();
    }
}
