<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use function Lambdish\Phunctional\map;

final class QuizStepQuestionsType extends JsonType
{
    public const NAME = 'quiz_step_questions';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return map($this->questionFromValues(), parent::convertToPHPValue($value, $platform));
    }

    /** @var QuizStepQuestion[] $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return parent::convertToDatabaseValue(map($this->questionToValues(), $value), $platform);
    }

    private function questionFromValues(): callable
    {
        return static function (array $values): QuizStepQuestion {
            return QuizStepQuestion::fromValues($values);
        };
    }

    private function questionToValues(): callable
    {
        return static function (QuizStepQuestion $question): array {
            return $question->toValues();
        };
    }
}
