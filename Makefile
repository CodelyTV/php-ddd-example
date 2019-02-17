.PHONY: all deps build test run-tests

deps:
	@docker run --rm --interactive --tty --volume $(shell pwd):/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo install \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction \
			--no-scripts

build: deps start-containers

test:
	@make run-tests

run-tests:
	./vendor/bin/phpstan analyse -l 7 -c etc/phpstan/phpstan.neon applications/mooc_backend/src
	./vendor/bin/phpunit --exclude-group='disabled'
	./vendor/bin/behat -p all_applications --format=progress -v
	./vendor/bin/behat -p mooc_backend --format=progress -v

start-containers:
	@docker-compose up -d
