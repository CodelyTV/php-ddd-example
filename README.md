<img src="http://codely.tv/wp-content/uploads/2016/05/cropped-logo-codelyTV.png" align="left" width="192px" height="192px"/>
<img align="left" width="0" height="192px" hspace="10"/>

> Keep it simple :)

[![CodelyTV](https://img.shields.io/badge/code-codely-green.svg?style=flat-square)](codely.tv) [![CircleCI](https://circleci.com/gh/CodelyTV/cqrs-ddd-php-example/tree/master.svg?style=svg&circle-token=ce12d04556fa79b78bb2beefa0356a6f6934b26b)](https://circleci.com/gh/CodelyTV/cqrs-ddd-example/tree/master)

**CodelyTv** is the way to rediscover the programming ;) Trusted by more than 1000 youtube subscribers.

Trust in **Codely**, trust in **you**.

## Quick Start
This is a simple demo of a CQRS project.

### 1. Clone this repo
Execute: `git clone https://github.com/CodelyTV/cqrs-ddd-example`

### 2. Start the docker compose
Rename .env.dist to .env and fill with your necessary information
Run `docker-compose up -d`

### 2. Install all the dependencies
Composer is used to handle the dependencies. You can download it executing:
`curl -sS https://getcomposer.org/installer | php`

And then you can install all the dependencies and setting your parameters executing:
`php composer.phar install`

### 3. Run the tests!
Once you have all the dependencies, in order to execute the tests, run this command:
`vendor/bin/behat -p api` // This will also create the needed databases.
`vendor/bin/behat -p applications`
`vendor/bin/phpunit`

## Contributing
There are some things missing (add swagger, improve documentation...), feel free to add this if you want! If you want 
some guidelines feel free to contact us :)

## Extra
This code was show in the [From framework coupled code to #microservices through #DDD](http://codely.tv/screencasts/codigo-acoplado-framework-microservicios-ddd) talk
and doubts where answered in [DDD y CQRS: Preguntas Frecuentes](http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes/) video.
