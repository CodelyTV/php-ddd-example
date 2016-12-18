<?php

namespace CodelyTv\Test\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Exception;
use Symfony\Component\Process\Process;

final class CommandContext implements Context
{
    use KernelDictionary;

    /**
     * @var Process
     */
    private $process;

    /**
     * @When I run the command :commands
     */
    public function iRunTheCommand($command)
    {
        $cwd     = $this->getKernel()->getRootDir();
        $command = sprintf('./bin/console %s --env=%s', $command, 'test');

        $this->runProcess(new Process($command, $cwd));
    }

    /**
     * @Then /^the background command should have run successfully$/
     */
    public function theBackgroundCommandShouldHaveRunSuccesfully()
    {
        if (!$this->process->isSuccessful()) {
            throw new Exception(
                sprintf(
                    'exit code: %s (%s) %s',
                    $this->process->getExitCode(),
                    $this->process->getExitCodeText(),
                    $this->process->getErrorOutput()
                )
            );
        }
    }

    public function runProcess(Process $process)
    {
        $this->process = $process;
        $this->process->run();
    }

    /**
     * @Then the command output should be:
     */
    public function theCommandOutputShouldBe(PyStringNode $expectedOutput)
    {
        $ouput = $this->process->getOutput();
        $formattedExpectedOutput = implode("\n", $expectedOutput->getStrings()) . "\n";

        if ($ouput != $formattedExpectedOutput) {
            throw new Exception(sprintf('The output %s is not equals that expected one %s', $ouput, $expectedOutput));
        }
    }

    /**
     * @Then the command should fail
     */
    public function theCommandShouldFail()
    {
        if (null === $this->process->getErrorOutput()) {
            throw new Exception('The command has not crashed');
        }
    }
}
