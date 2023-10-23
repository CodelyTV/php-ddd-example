current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

composer-install:
	@docker run --rm $(INTERACTIVE) --volume $(current-dir):/app --user $(id -u):$(id -g) \
		composer:2.6.4 install \
			--ignore-platform-reqs \
			--no-ansi

test:
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/phpunit --testsuite mooc -c tools/phpunit.xml
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/phpunit --testsuite shared -c tools/phpunit.xml
	docker exec codely-php_ddd_example-backoffice_backend-php ./vendor/bin/phpunit --testsuite backoffice -c tools/phpunit.xml
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/behat -p mooc_backend --format=progress -v -c tools/behat.yml

static-analysis:
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/psalm --output-format=github --shepherd -c tools/psalm.xml

lint:
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/ecs check -c ./tools/ecs.php

test-architecture:
	docker exec codely-php_ddd_example-mooc_backend-php php -d memory_limit=4G ./vendor/bin/phpstan analyse --error-format github -c tools/phpstan.neon

mess-detector:
	docker exec codely-php_ddd_example-mooc_backend-php ./vendor/bin/phpmd apps,src,tests github tools/phpmd.xml

start:
	@if [ ! -f .env.local ]; then echo '' > .env.local; fi
	UID=${shell id -u} GID=${shell id -g} docker compose up --build -d
	make clean-cache

stop:
	UID=${shell id -u} GID=${shell id -g} docker compose stop

destroy:
	UID=${shell id -u} GID=${shell id -g} docker compose down

rebuild:
	docker compose build --pull --force-rm --no-cache
	make install
	make start

ping-mysql:
	@docker exec codely-php_ddd_example-mooc-mysql mysqladmin --user=root --password= --host "127.0.0.1" ping --silent

ping-elasticsearch:
	@curl -I -XHEAD localhost:9200

ping-rabbitmq:
	@docker exec codely-php_ddd_example-rabbitmq rabbitmqctl ping --silent

clean-cache:
	@rm -rf apps/*/*/var
	@docker exec codely-php_ddd_example-mooc_backend-php ./apps/mooc/backend/bin/console cache:warmup
