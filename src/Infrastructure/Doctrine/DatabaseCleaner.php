<?php

namespace CodelyTv\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\map;

final class DatabaseCleaner
{
    public function __invoke(EntityManagerInterface $entityManager)
    {
        $connection = $entityManager->getConnection();

        $tables            = $this->tables($connection);
        $truncateTablesSql = $this->truncateDatabaseSql($tables);

        $connection->exec($truncateTablesSql);
    }

    private function truncateDatabaseSql(array $tables)
    {
        $truncateTables = map($this->truncateTableSql(), $tables);

        return sprintf('SET FOREIGN_KEY_CHECKS = 0; %s SET FOREIGN_KEY_CHECKS = 1;', implode(' ', $truncateTables));
    }

    private function truncateTableSql()
    {
        return function (array $table) {
            return sprintf('TRUNCATE TABLE `%s`;', first($table));
        };
    }

    private function tables(Connection $connection)
    {
        return $connection->query('SHOW TABLES')->fetchAll();
    }
}
