<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Behat\ApiContext;

use Behat\Gherkin\Node\PyStringNode;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkHelper;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkSessionResponseHelper;
use CodelyTv\Test\Shared\Infrastructure\PHPUnit\Constraint\CodelyTvConstraintIsSimilar;
use DateTimeImmutable;
use PHPUnit\Framework\Assert;
use RuntimeException;
use function CodelyTv\Utils\date_to_string;

final class ApiResponseContext extends RawMinkContext
{
    /** @var MinkSessionResponseHelper */
    private $sessionResponseHelper;
    /** @return MinkHelper */
    private $sessionHelper;

    public static function assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = ''): void
    {
        Assert::assertJson($expectedJson, 'The expected value is not a valid json');
        Assert::assertJson($actualJson, 'The actual value is not a valid json');

        $expected = json_decode($expectedJson);
        $actual   = json_decode($actualJson);

        Assert::assertThat(
            $actual,
            new CodelyTvConstraintIsSimilar($expected, 20), // @todo For functional
            $message
        );
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expected): void
    {
        if ($this->getSessionHelper()->getResponseHeader('content-type') === 'application/json') {
            self::assertJsonStringEqualsJsonString(
                $this->adaptExpected($expected->getRaw()),
                $this->getSessionResponseHelper()->getResponse(),
                sprintf('The string "%s" is not equal to the response of the current page', $expected)
            );
        } else {
            Assert::assertEquals(
                $expected->getRaw(),
                $this->getSessionResponseHelper()->getResponse(),
                sprintf('The string "%s" is not equal to the response of the current page', $expected)
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        Assert::assertEmpty(
            $this->getSessionResponseHelper()->getResponse(),
            'The response of the current page is not empty'
        );
    }

    /**
     * @Then print last api response
     */
    public function printApiResponse(): void
    {
        print_r($this->getSessionResponseHelper()->getResponse());
    }

    /**
     * @Then the response parameter :name should exist
     */
    public function theResponseParameterShouldExist($name): void
    {
        if (!$this->getSessionHelper()->hasResponseParameter($name)) {
            throw new RuntimeException(sprintf('Parameter "%s" does not exists in response', $name));
        }
    }

    /**
     * @Then the response parameter :name should match :regex
     */
    public function theResponseParameterShouldMatch($name, $regex): void
    {
        $value        = $this->getSessionHelper()->getResponseParameter($name);
        $errorMessage = vsprintf(
            'The response parameter "%s" is "%s" and it should match "%s" but it does not.',
            [$name, $value, $regex]
        );

        Assert::assertRegExp($regex, (string) $value, $errorMessage);
    }

    /**
     * @Then the response parameter :name should be :expectedValue
     */
    public function theResponseParameterShouldBe($name, $expectedValue): void
    {
        $value = $this->getSessionHelper()->getResponseParameter($name);
        Assert::assertEquals($expectedValue, $value);
    }

    /**
     * @Then print response headers
     */
    public function printResponseHeaders(): void
    {
        print_r($this->getSessionHelper()->getResponseHeaders());
    }

    /**
     * @Then the response header :name should be :value
     */
    public function theResponseHeaderShouldBe($name, $value): void
    {
        $this->theHeaderShouldExists($name);

        $header = $this->getSessionHelper()->getResponseHeader($name);

        Assert::assertSame(
            $value,
            $header,
            sprintf('The header "%s" is equal to "%s"', $name, $header)
        );
    }

    /**
     * @Then the response header :name should exists
     */
    public function theHeaderShouldExists($name): void
    {
        if (!$this->getSessionHelper()->hasResponseHeader($name)) {
            throw new RuntimeException(sprintf('The header "%s" does not exists', $name));
        }
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode): void
    {
        Assert::assertSame((int) $expectedResponseCode, $this->getSession()->getStatusCode());
    }

    private function getSessionResponseHelper(): MinkSessionResponseHelper
    {
        return $this->sessionResponseHelper = $this->sessionResponseHelper ?: new MinkSessionResponseHelper(
            $this->getSessionHelper()
        );
    }

    private function getSessionHelper(): MinkHelper
    {
        return $this->sessionHelper = $this->sessionHelper ?: new MinkHelper($this->getSession());
    }

    private function adaptExpected($expectedResponse)
    {
        return $this->convertRelativeDates($expectedResponse);
    }

    private function convertRelativeDates($expectedResponse)
    {
        if (preg_match_all('/\#date (?<dates>[^\#]+)\#/', $expectedResponse, $matches)) {
            foreach ($matches['dates'] as $date) {
                $expectedResponse = str_replace(
                    sprintf('#date %s#', $date),
                    date_to_string(new DateTimeImmutable($date)),
                    $expectedResponse
                );
            }
        }

        return $expectedResponse;
    }
}
