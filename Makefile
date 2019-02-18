.PHONY: all deps build test run-tests

deps:
	@docker run --rm --interactive --tty --volume $(shell pwd):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo install \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction

build: deps start

test:
	@docker exec -it codelytv-cqrs_ddd_php_example-php make run-tests

run-tests:
	./vendor/bin/phpstan analyse -l 7 -c etc/phpstan/phpstan.neon applications/mooc_backend/src
	./vendor/bin/phpunit --exclude-group='disabled'
	./vendor/bin/behat -p all_applications --format=progress -v
	./vendor/bin/behat -p mooc_backend --format=progress -v

start:
	@docker-compose up -d

stop:
	@docker-compose stop

destroy:
	@docker-compose down
