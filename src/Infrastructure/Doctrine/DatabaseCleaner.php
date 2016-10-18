<?php

namespace CodelyTv\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

final class DatabaseCleaner
{
    public function __invoke(EntityManager $entityManager)
    {
        $allMetadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $database    = new SchemaTool($entityManager);

        $database->dropSchema($allMetadata);
        $database->createSchema($allMetadata);
    }
}
