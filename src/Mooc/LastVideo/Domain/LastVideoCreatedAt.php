<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\ValueObject\DateValueObject;

final class LastVideoCreatedAt extends DateValueObject{

    public function isBefore(LastVideoCreatedAt $date): bool
    {
        return $this->isSmallerThan($date);
    }

}
