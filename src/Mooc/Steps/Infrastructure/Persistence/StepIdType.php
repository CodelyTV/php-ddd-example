<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Infrastructure\Persistence;

use CodelyTv\Mooc\Steps\Domain\StepId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class StepIdType extends StringType
{
    public const NAME = 'step_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new StepId($value);
    }

    /** @var StepId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}
