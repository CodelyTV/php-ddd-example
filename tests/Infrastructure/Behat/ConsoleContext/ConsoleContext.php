<?php

namespace CodelyTv\Test\Infrastructure\Behat\ConsoleContext;

use Behat\Behat\Context\Context;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Exception;
use Symfony\Component\Process\Process;

final class ConsoleContext implements Context
{
    use KernelDictionary;
    /** @var Process */
    private $process;

    /**
     * @When /^I run the "([^"]*)" console$/
     */
    public function iRunTheApplicationConsole($app)
    {
        $command              = './bin/console';
        $applicationDirectory = sprintf('%s/../../../../applications/%s', __DIR__, $app);

        $this->runProcess(new Process($command, $applicationDirectory));
    }

    public function runProcess(Process $process)
    {
        $this->process = $process;
        $this->process->run();
    }

    /**
     * @Then /^the console command should run successfully$/
     */
    public function theConsoleCommandShouldRunSuccessfully()
    {
        if (!$this->process->isSuccessful()) {
            throw new Exception(
                sprintf(
                    'The command should run successfully, but it returns the <%f> exit code and this output: %s',
                    $this->process->getExitCode(),
                    $this->process->getExitCodeText()
                )
            );
        }
    }
}
