.PHONY: all deps composer-install composer-update build test run-tests

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

deps: composer-install

composer-install: CMD=install
composer-update: CMD=update

# Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
composer composer-install composer-update:
	@docker run --rm --interactive --tty --volume $(current-dir):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo $(CMD) \
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
	./vendor/bin/behat -p mooc_backend --format=progress -v

start:
	@docker-compose up -d

stop:
	@docker-compose stop

destroy:
	@docker-compose down
