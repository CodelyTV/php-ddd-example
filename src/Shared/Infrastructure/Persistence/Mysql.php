<?php
declare(strict_types=1);


namespace CodelyTv\Shared\Infrastructure\Persistence;

use PDO;

final class Mysql
{
    private PDO $pdo;

    public function __construct(string $host, string $username)
    {
        var_dump($host, $username);
        $this->pdo = new PDO(sprintf('mysql:host=mysql;dbname=%s', $host), $username, '');
    }
}