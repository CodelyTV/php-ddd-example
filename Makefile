.PHONY: build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild start-local ping-mysql composer-require composer-require-module

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

build: deps start

deps: composer-install

# 🐘 Composer
composer-env-file:
	@if [ ! -f .env.local ]; then echo '' > .env.local; fi

composer-install: CMD=install
composer-update: CMD=update
composer-require: CMD=require
composer-require: INTERACTIVE=-ti --interactive
composer-require-module: CMD=require $(module)
composer-require-module: INTERACTIVE=-ti --interactive
composer composer-install composer-update composer-require composer-require-module: composer-env-file
	@docker run --rm $(INTERACTIVE) --volume $(current-dir):/app --user $(id -u):$(id -g) \
		composer:2 $(CMD) \
			--ignore-platform-reqs \
			--no-ansi

reload: composer-env-file
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

test: composer-env-file
	docker exec codelytv-php_ddd_skeleton-mooc_backend-php ./vendor/bin/phpunit --testsuite mooc
	docker exec codelytv-php_ddd_skeleton-mooc_backend-php ./vendor/bin/phpunit --testsuite shared
	docker exec codelytv-php_ddd_skeleton-mooc_backend-php ./vendor/bin/behat -p mooc_backend --format=progress -v
	docker exec codelytv-php_ddd_skeleton-backoffice_backend-php ./vendor/bin/phpunit --testsuite backoffice

run-tests: composer-env-file
	mkdir -p build/test_results/phpunit
	./vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml --testsuite backoffice
	./vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml --testsuite mooc
	./vendor/bin/phpunit --exclude-group='disabled' --log-junit build/test_results/phpunit/junit.xml --testsuite shared
	./vendor/bin/behat -p mooc_backend --format=progress -v

# 🐳 Docker Compose
start: CMD=up -d
stop: CMD=stop
destroy: CMD=down

# Usage: `make doco CMD="ps --services"`
# Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
doco start stop destroy: composer-env-file
	@docker-compose $(CMD)

rebuild: composer-env-file
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

ping-mysql:
	@docker exec codelytv-php_ddd_skeleton-mooc-mysql mysqladmin --user=root --password= --host "127.0.0.1" ping --silent

clean-cache:
	@rm -rf apps/*/*/var
	@docker exec codelytv-php_ddd_skeleton-backoffice_backend-php ./apps/backoffice/backend/bin/console cache:warmup
	@docker exec codelytv-php_ddd_skeleton-backoffice_frontend-php ./apps/backoffice/frontend/bin/console cache:warmup
	@docker exec codelytv-php_ddd_skeleton-mooc_backend-php ./apps/mooc/backend/bin/console cache:warmup
