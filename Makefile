current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.PHONY: build
build: deps start

.PHONY: deps
deps: composer-install

# 🐘 Composer
composer-env-file:
	@if [ ! -f .env.local ]; then echo '' > .env.local; fi

.PHONY: composer-install
composer-install: CMD=install

.PHONY: composer-update
composer-update: CMD=update

.PHONY: composer-require
composer-require: CMD=require
composer-require: INTERACTIVE=-ti --interactive

.PHONY: composer-require-module
composer-require-module: CMD=require $(module)
composer-require-module: INTERACTIVE=-ti --interactive

.PHONY: composer
composer composer-install composer-update composer-require composer-require-module: composer-env-file
	@docker run --rm $(INTERACTIVE) --volume $(current-dir):/app --user $(id -u):$(id -g) \
		composer:2 $(CMD) \
			--ignore-platform-reqs \
			--no-ansi

.PHONY: reload
reload: composer-env-file
	@docker-compose exec php-fpm kill -USR2 1
	@docker-compose exec nginx nginx -s reload

.PHONY: static-analysis
static-analysis: composer-env-file
	docker exec openflight-php ./vendor/bin/psalm


# 🐳 Docker Compose
.PHONY: start
start: CMD=up --build -d

.PHONY: start-service
start-service:
	docker exec -i openflight-mysql mysql < ./etc/databases/openflight.sql

.PHONY: stop
stop: CMD=stop

.PHONY: destroy
destroy: CMD=down

# Usage: `make doco CMD="ps --services"`
# Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
.PHONY: doco
doco start stop destroy: composer-env-file
	@docker-compose $(CMD)

.PHONY: rebuild
rebuild: composer-env-file
	docker-compose build --pull --force-rm --no-cache
	make deps
	make start

.PHONY: ping-mysql
ping-mysql:
	@docker exec openflight-mysql mysqladmin --user=root --password= --host "127.0.0.1" ping --silent

clean-cache:
	@rm -rf apps/*/*/var
	@docker exec openflight-php ./apps/openflight/backend/bin/console cache:warmup
