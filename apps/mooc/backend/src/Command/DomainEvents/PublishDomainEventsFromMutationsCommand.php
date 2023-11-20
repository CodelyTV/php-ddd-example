<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Command\DomainEvents;

use CodelyTv\Mooc\Courses\Infrastructure\Cdc\DatabaseMutationToCourseCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Infrastructure\Cdc\DatabaseMutationAction;
use CodelyTv\Shared\Infrastructure\Cdc\DatabaseMutationToDomainEvent;
use Doctrine\ORM\EntityManager;
use RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
	name: 'codely:domain-events:generate-from-mutations',
	description: 'Publish domain events from mutations',
)]
final class PublishDomainEventsFromMutationsCommand extends Command
{
	private array $transformers;

	public function __construct(
		private readonly EntityManager $entityManager,
		private readonly EventBus $eventBus
	) {
		parent::__construct();

		$this->transformers = [
			'courses' => [
				DatabaseMutationAction::INSERT->value => DatabaseMutationToCourseCreatedDomainEvent::class,
				DatabaseMutationAction::UPDATE->value => null,
				DatabaseMutationAction::DELETE->value => null,
			],
		];
	}

	protected function configure(): void
	{
		$this->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of mutations to process');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$totalMutations = (int) $input->getArgument('quantity');

		$this->entityManager->wrapInTransaction(function (EntityManager $entityManager) use ($totalMutations) {
			$mutations = $entityManager->getConnection()
				->executeQuery("SELECT * FROM mutations ORDER BY id ASC LIMIT $totalMutations FOR UPDATE")
				->fetchAllAssociative();

			foreach ($mutations as $mutation) {
				$transformer = $this->findTransformer($mutation['table_name'], $mutation['operation']);

				if ($transformer === null) {
					echo sprintf("Ignoring %s %s\n", $mutation['table_name'], $mutation['operation']);
					continue;
				}

				$domainEvents = $transformer->transform($mutation);

				$this->eventBus->publish(...$domainEvents);
			}

			$entityManager->getConnection()->executeStatement(
				sprintf('DELETE FROM mutations WHERE id IN (%s)', implode(',', array_column($mutations, 'id')))
			);
		});

		return 0;
	}

	private function findTransformer(string $tableName, string $operation): ?DatabaseMutationToDomainEvent
	{
		if (!array_key_exists($tableName, $this->transformers) && array_key_exists(
			$operation,
			$this->transformers[$tableName]
		)) {
			throw new RuntimeException("Transformer not found for table $tableName and operation $operation");
		}

		/** @var class-string<DatabaseMutationToDomainEvent>|null $class */
		$class = $this->transformers[$tableName][$operation];

		return $class ? new $class() : null;
	}
}
