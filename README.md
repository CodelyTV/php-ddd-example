<img src="http://codely.tv/wp-content/uploads/2016/05/cropped-logo-codelyTV.png" align="left" width="192px" height="192px"/>
<img align="left" width="0" height="192px" hspace="10"/>

> You can do awesome stuff with php :)

[![CodelyTV](https://img.shields.io/badge/code-codely-green.svg?style=flat-square)](codely.tv)
[![CircleCI](https://circleci.com/gh/CodelyTV/cqrs-ddd-php-example/tree/master.svg?style=svg&circle-token=ce12d04556fa79b78bb2beefa0356a6f6934b26b)](https://circleci.com/gh/CodelyTV/cqrs-ddd-php-example/tree/master)

Implementation example of a PHP application following Domain-Driven Design (DDD) and Command Query Responsibility Segregation (CQRS) principles, keeping the code as simple as possible.

Used by the CodelyTV Pro courses:
* [Arquitectura Hexagonal (Spanish)](https://pro.codely.tv/library/arquitectura-hexagonal/66748/about/)
* [CQRS: Command Query Responsibility Segregation (Spanish)](https://pro.codely.tv/library/cqrs-command-query-responsibility-segregation-3719e4aa/62554/about/)

## Environment setup

### Install the needed tools
1. Clone this repository: `git clone https://github.com/CodelyTV/cqrs-ddd-php-example cqrs-ddd-php-example`
2. Move to your project folder: `cd cqrs-ddd-php-example`
3. Install dependencies: `php composer.phar install`

### Run the tests!
Once you have all the dependencies, in order to execute the tests, run this command:
`vendor/bin/behat -p api` // This will also create the needed databases.
`vendor/bin/behat -p applications`
`vendor/bin/phpunit`

### Run the environment
While this doesn't have docker integration (feel free to do a pull request :) we need a few thing to run this together.
 1. A [MySQL](https://www.mysql.com/) database
     * Execute all `.sql` from `/databases` dir
 2. [Apache](https://httpd.apache.org/)/[Nginx](https://nginx.org/en/)
 3. [Supervisord](http://supervisord.org/)
     * Execute the `applications/api/bin/console codelytv:domain-events:generate-supervisor-files` command
     * Link the `applications/api/app/config/supervisor` folder to the supervisor config one
     * Start supervisord

## Contributing
There are some things missing (add swagger, improve documentation...), feel free to add this if you want! If you want 
some guidelines feel free to contact us :)

## Extra
This code was show in the [From framework coupled code to #microservices through #DDD](http://codely.tv/screencasts/codigo-acoplado-framework-microservicios-ddd) talk and doubts where answered in [DDD y CQRS: Preguntas Frecuentes](http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes/) video.
