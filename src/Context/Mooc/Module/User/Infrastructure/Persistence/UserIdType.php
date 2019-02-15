<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\User\Infrastructure\Persistence;

use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class UserIdType extends StringType
{
    const NAME = 'user_id';

    public function getName()
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserId($value);
    }

    /** @var UserId $value */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}

