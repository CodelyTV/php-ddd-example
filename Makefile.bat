@echo off

set current-dir=%~dp0
set current-dir=%current-dir:\=/%

CALL :%1
EXIT /B %ERRORLEVEL%

REM 👌 Main targets

:build
	CALL :deps
	CALL :start
	EXIT /B 0

:deps 
	CALL :composer-install
	EXIT /B 0

REM 🐘 Composer

:composer-install
	set CMD=install
	GOTO :composer
	EXIT /B 0

:composer-update
	set CMD=update
	GOTO :composer
	EXIT /B 0

REM Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
:composer
	docker run --rm --interactive --tty --volume %current-dir%:/app ^
		gsingh1/prestissimo %CMD% ^
			--ignore-platform-reqs ^
			--no-ansi ^
			--no-interaction
	EXIT /B 0

REM 🕵️ Clear cache
REM OpCache: Restarts the unique process running in the PHP FPM container
REM Nginx: Reloads the server

:reload
	docker-compose exec php-fpm kill -USR2 1
	docker-compose exec nginx nginx -s reload
	EXIT /B 0

REM ✅ Tests

:test
	docker exec -it codelytv-cqrs_ddd_php_example-php make run-tests
	EXIT /B 0

REM 🐳 Docker Compose

:start
	docker-compose up -d
	EXIT /B 0

:stop 
	set CMD=stop
	CALL :compose
	EXIT /B 0

:destroy 
	set CMD=down
	CALL :compose
	EXIT /B 0

:compose
	docker-compose %CMD%
	EXIT /B 0

:rebuild
	@echo "docker-compose build --pull --force-rm --no-cache"
	docker-compose build --pull --force-rm --no-cache
	@echo "composer-install"
	CALL :deps
	@echo "start"
	CALL :start
	EXIT /B 0
	