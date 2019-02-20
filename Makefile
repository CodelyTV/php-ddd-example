.PHONY: all deps composer-install composer-update build test run-tests

deps: composer-install

composer-install:
	@docker run --rm --interactive --tty --volume $(shell pwd):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo install \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction

composer-update:
	@docker run --rm --interactive --tty --volume $(shell pwd):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo update \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction

build: deps start

test:
	@docker exec -it codelytv-cqrs_ddd_php_example-php make run-tests

run-tests:
	mkdir -p build/test_results/phpunit
	./vendor/bin/phpstan analyse -l 7 -c etc/phpstan/phpstan.neon applications/mooc_backend/src
	./vendor/bin/phpunit --exclude-group='disabled --log-junit build/test_results/phpunit/junit.xml tests'
	./vendor/bin/behat -p all_applications --format=progress -v
	./vendor/bin/behat -p mooc_backend --format=progress -v

start:
	@docker-compose up -d

stop:
	@docker-compose stop

destroy:
	@docker-compose down
