@echo off

set current-dir=%~dp0
set current-dir=%current-dir:\=/%

CALL :%1
GOTO :end

REM 👌 Main targets

:build
	CALL :deps
	CALL :start
	GOTO :end

:deps 
	CALL :composer-install
	GOTO :end

REM 🐘 Composer

:composer-install
	set CMD=install
	GOTO :composer
	GOTO :end

:composer-update
	set CMD=update
	GOTO :composer
	GOTO :end

REM Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
:composer
	docker run --rm --interactive --tty --volume %current-dir%:/app ^
		gsingh1/prestissimo %CMD% ^
			--ignore-platform-reqs ^
			--no-ansi ^
			--no-interaction
	GOTO :end

REM 🕵️ Clear cache
REM OpCache: Restarts the unique process running in the PHP FPM container
REM Nginx: Reloads the server

:reload
	docker-compose exec php-fpm kill -USR2 1
	docker-compose exec nginx nginx -s reload
	GOTO :end

REM ✅ Tests

:test
	docker exec -it codelytv-cqrs_ddd_php_example-php make run-tests
	GOTO :end

REM 🐳 Docker Compose

:start
	docker-compose up -d
	GOTO :end

:stop 
	docker-compose stop
	GOTO :end

:destroy 
	docker-compose down
	GOTO :end

REM Usage: `make doco CMD="ps --services"`
REM Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
:doco
:stop
:destroy
	docker-compose %CMD%
	GOTO :end

:rebuild
	@echo "docker-compose build --pull --force-rm --no-cache"
	docker-compose build --pull --force-rm --no-cache
	@echo "composer-install"
	CALL :deps
	@echo "start"
	CALL :start
	GOTO :end

:end