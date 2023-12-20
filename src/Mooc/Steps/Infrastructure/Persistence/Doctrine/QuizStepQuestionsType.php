<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use CodelyTv\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;

use function Lambdish\Phunctional\map;

final class QuizStepQuestionsType extends JsonType implements DoctrineCustomType
{
	public static function customTypeName(): string
	{
		return 'quiz_step_questions';
	}

	public function getName(): string
	{
		return self::customTypeName();
	}

	public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
	{
		return parent::convertToDatabaseValue(
			map(fn (QuizStepQuestion $question): string => $question->toString(), $value),
			$platform
		);
	}

	public function convertToPHPValue($value, AbstractPlatform $platform): array
	{
		$scalars = parent::convertToPHPValue($value, $platform);

		return map(fn (string $value): QuizStepQuestion => QuizStepQuestion::fromString($value), $scalars);
	}
}
