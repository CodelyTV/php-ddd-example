<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Doctrine;

use CodelyTv\Shared\Infrastructure\Doctrine\Dbal\DbalCustomTypesRegistrar;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Platforms\MariaDBPlatform;
use Doctrine\DBAL\Schema\DefaultSchemaManagerFactory;
use Doctrine\DBAL\Schema\MySQLSchemaManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;
use Doctrine\ORM\ORMSetup;
use RuntimeException;

use function Lambdish\Phunctional\dissoc;

final class DoctrineEntityManagerFactory
{
	private static array $sharedPrefixes = [
		__DIR__ . '/../../../Shared/Infrastructure/Persistence/Mappings' => 'CodelyTv\Shared\Domain',
	];

	public static function create(
		array $parameters,
		array $contextPrefixes,
		bool $isDevMode,
		string $schemaFile,
		array $dbalCustomTypesClasses
	): EntityManager {
		if ($isDevMode) {
			self::generateDatabaseIfNotExists($parameters, $schemaFile);
		}

		DbalCustomTypesRegistrar::register($dbalCustomTypesClasses);

		$config = self::createConfiguration($contextPrefixes, $isDevMode);
		$eventManager = new EventManager();

		return new EntityManager(
			DriverManager::getConnection($parameters, $config, $eventManager),
			$config,
			$eventManager
		);
	}

	private static function generateDatabaseIfNotExists(array $parameters, string $schemaFile): void
	{
		self::ensureSchemaFileExists($schemaFile);

		$databaseName = $parameters['dbname'];
		$parametersWithoutDatabaseName = dissoc($parameters, 'dbname');
		$connection = DriverManager::getConnection($parametersWithoutDatabaseName);
		$platform = new MariaDBPlatform();
		$schemaManager = new MySQLSchemaManager($connection, $platform);

		if (!self::databaseExists($databaseName, $schemaManager)) {
			$schemaManager->createDatabase($databaseName);

			$connection->executeStatement(sprintf('USE %s', $databaseName));
			$connection->executeStatement(file_get_contents(realpath($schemaFile)));
		}

		$connection->close();
	}

	private static function databaseExists(string $databaseName, MySqlSchemaManager $schemaManager): bool
	{
		return in_array($databaseName, $schemaManager->listDatabases(), true);
	}

	private static function ensureSchemaFileExists(string $schemaFile): void
	{
		if (!file_exists($schemaFile)) {
			throw new RuntimeException(sprintf('The file <%s> does not exist', $schemaFile));
		}
	}

	private static function createConfiguration(array $contextPrefixes, bool $isDevMode): Configuration
	{
		$config = ORMSetup::createConfiguration($isDevMode);

		$config->setMetadataDriverImpl(new SimplifiedXmlDriver(array_merge(self::$sharedPrefixes, $contextPrefixes)));
		$config->setSchemaManagerFactory(new DefaultSchemaManagerFactory());

		return $config;
	}
}
