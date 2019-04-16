<p align="center">
  <a href="http://codely.tv">
    <img src="http://codely.tv/wp-content/uploads/2016/05/cropped-logo-codelyTV.png" width="192px" height="192px"/>
  </a>
</p>

<h1 align="center">
  🐘🎯 Hexagonal Architecture, DDD & CQRS in PHP Symfony
</h1>

<p align="center">
    <a href="https://github.com/CodelyTV"><img src="https://img.shields.io/badge/CodelyTV-OS-green.svg?style=flat-square" alt="codely.tv"/></a>
    <a href="http://pro.codely.tv"><img src="https://img.shields.io/badge/CodelyTV-PRO-black.svg?style=flat-square" alt="CodelyTV Courses"/></a>
    <a href="#"><img src="https://img.shields.io/badge/Symfony-4.2-purple.svg?style=flat-square&logo=symfony" alt="Symfony 4.2"/></a>
    <a href="https://circleci.com/gh/CodelyTV/cqrs-ddd-php-example/tree/master"><img src="https://circleci.com/gh/CodelyTV/cqrs-ddd-php-example/tree/master.svg?style=svg&circle-token=ce12d04556fa79b78bb2beefa0356a6f6934b26b" alt="CircleCI Status"/></a>
</p>

<p align="center">
  Example of a PHP application following Domain-Driven Design (DDD) and
  Command Query Responsibility Segregation (CQRS) principles keeping the code as simple as possible.
  <br />
  <br />
  Take a look, play and have fun with this.
  <a href="https://github.com/CodelyTV/cqrs-ddd-php-example/stargazers">Stars are welcomed 😊</a>
  <br />
  <br />
  <a href="#table-of-contents"><strong>Explore the docs »</strong></a>
  <br />
  <br />
  <a href="https://www.youtube.com/watch?v=1kaP39W80zQ">View Demo</a>
  ·
  <a href="https://github.com/CodelyTV/cqrs-ddd-php-example/issues">Report Bug</a>
  ·
  <a href="https://github.com/CodelyTV/cqrs-ddd-php-example/issues">Request Feature</a>
</p>


<!-- TABLE OF CONTENTS -->
## Table of Contents

* [🚀 Environment setup](#-environment-setup)
  * [🐳 Needed tools](#-needed-tools)
  * [🛠️ Environment configuration](#-environment-configuration)
  * [🌍 Application execution](#-application-execution)
  * [✅ Tests execution](#-tests-execution)
* [🤔 Project explanation](#-project-explanation)
  * [Bounded Contexts](#-bounded-contexts)
  * [Hexagonal Architecture](#-hexagonal-architecture)
  * [Aggregates](#aggregates)
  * [Command Bus](#command-bus)
  * [Query Bus](#query-bus)
  * [Event Bus](#event-bus)
* [🤝 Contributing](#-contributing)
* [🤩 Extra](#-extra)

## 🚀 Environment setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/CodelyTV/cqrs-ddd-php-example cqrs-ddd-php-example`
3. Move to the project folder: `cd cqrs-ddd-php-example`

### 🛠️ Environment configuration

1. Copy the default environment variables: `cp .env.dist .env`
2. Modify the environment variables if needed: `vim .env`
3. Add `api.codelytv.localhost` domain to your local hosts: `echo "127.0.0.1 api.codelytv.localhost"| sudo tee -a /etc/hosts > /dev/null`

### 🌍 Application execution

1. Install PHP dependencies and bring up the project Docker containers with Docker Compose: `make build`
2. Go to [the API health check page](http://api.codelytv.localhost:8030/status)

### ✅ Tests execution

1. Install PHP dependencies if you haven't done so: `make deps`
2. Execute Behat and PHP Unit tests: `make test`

## 🤔 Project explanation

This project tries to be a MOOC (Massive Open Online Course) platform.
For now it only has an [API](applications/mooc_backend/src/Controller)
and some [Consumers](applications/mooc_backend/src/Command).

### ⛱️ Bounded Contexts

* [Mooc](src/Mooc): Place to look in if you wanna see some code 🙂. Massive Open Online Courses public platform with users, videos, notifications, and so on
* [Backoffice](src/Backoffice): Work in progress. Here you'll find the use cases needed by the Customer Support department in order to manage users, courses, videos, and so on.

### 🎯 Hexagonal Architecture

This repository follow the Hexagonal Architecture pattern. Also is structured using `modules`.
With this, we can see that the current structure of a Bounded Context is:

```scala
$ tree -L 4 src

src
|-- Mooc // Company subdomain / Bounded Context: Features related to one of the company business lines / products
|   `-- Videos // Some Module inside the Mooc context
|       |-- Application
|       |   |-- Create // Inside the application layer all is structured by actions
|       |   |   |-- CreateVideoCommand.php
|       |   |   |-- CreateVideoCommandHandler.php
|       |   |   `-- VideoCreator.php
|       |   |-- Find
|       |   |-- Trim
|       |   `-- Update
|       |-- Domain
|       |   |-- Video.php // The Aggregate of the Module
|       |   |-- VideoCreatedDomainEvent.php // A Domain Event
|       |   |-- VideoFinder.php
|       |   |-- VideoId.php
|       |   |-- VideoNotFound.php
|       |   |-- VideoRepository.php // The `Interface` of the repository is inside Domain
|       |   |-- VideoTitle.php
|       |   |-- VideoType.php
|       |   |-- VideoUrl.php
|       |   `-- Videos.php // A collection of our Aggregate
|       `-- Infrastructure // The infrastructure of our module
|           |-- DependencyInjection
|           `-- Persistence
|               `--VideoRepositoryMySql.php // An implementation of the repository
`-- Shared // Shared Kernel: Common infrastructure and domain shared between the different Bounded Contexts
    |-- Domain
    `-- Infrastructure
```

#### Repository pattern
Our repositories try to be as simple as possible usually only containing 2 methods `search` and `save`.
If we need some query with more filters we use the `Strategy` pattern also known as `Criteria` pattern. So we add a
`searchByCriteria` method.

You can see an example [here](src/Mooc/Videos/Domain/VideoRepository.php)
and its implementation [here](src/Mooc/Videos/Infrastructure/Persistence/VideoRepositoryMySql.php).

### Aggregates
You can see an example of an aggregate [here](src/Mooc/Videos/Domain/Video.php). All aggregates should
extends the [AggregateRoot](src/Shared/Domain/Aggregate/AggregateRoot.php).

### Command Bus
There are 2 implementations of the [command bus](src/Shared/Domain/Bus/Command/CommandBus.php).
1. [Sync](src/Shared/Infrastructure/Bus/Command/SymfonySyncCommandBus.php) using the Symfony Message Bus
2. [Async](src/Shared/Infrastructure/Bus/Command/CommandBusAsync.php) using a local file

### Query Bus
The [Query Bus](src/Shared/Infrastructure/Bus/Query/SymfonySyncQueryBus.php) uses the Symfony Message Bus.

### Event Bus
The [Event Bus](src/Shared/Infrastructure/Bus/Event/SymfonySyncEventBus.php) uses the Symfony Message Bus.

## 🤔 Contributing
There are some things missing (add swagger, improve documentation...), feel free to add this if you want! If you want
some guidelines feel free to contact us :)

## 🤩 Extra
This code was show in the [From framework coupled code to #microservices through #DDD](http://codely.tv/screencasts/codigo-acoplado-framework-microservicios-ddd) talk and doubts where answered in [DDD y CQRS: Preguntas Frecuentes](http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes/) video.

🎥 Used in the CodelyTV Pro courses:
* [🇪🇸 Arquitectura Hexagonal](https://pro.codely.tv/library/arquitectura-hexagonal/66748/about/)
* [🇪🇸 CQRS: Command Query Responsibility Segregation](https://pro.codely.tv/library/cqrs-command-query-responsibility-segregation-3719e4aa/62554/about/)
* [🇪🇸 Comunicación entre microservicios: Event-Driven Architecture](https://pro.codely.tv/library/comunicacion-entre-microservicios-event-driven-architecture/74823/about/)
