## Requirements

To run the Check24 test project, you need to have Docker and Docker Compose installed on your machine.

Docs: https://docs.docker.com/engine/install/

## Installation

To install the Check24 test project, follow these commands:

```bash
  docker compose build --no-cache  
```

This command creates the Docker images needed to run the project.

## Start the Container

Then, you can start the container with this command


```bash
  docker compose up -d
```

The -d option starts the container in the background.

### Stop the Container
If you want to stop the container, you can use the following command:

```bash
  docker compose down
```

This will shut down and remove the container and related services.

## Install Dependencies

To install the project dependencies, run the following commands:

```bash
  docker compose exec php /bin/bash 
  composer install 
```

The first command will take you to a shell inside the PHP container, where you can execute Composer commands. composer install will install all PHP dependencies defined in the composer.json file.

## Execute Commands

To execute commands inside the PHP container, you must first enter the container shell:

```bash
  docker compose exec php /bin/bash 
```

Once inside the container, you can execute specific commands. For example, to execute a command called insurance:quote with data from a data.json file, you can use:

```bash
  bin/console insurance:quote "$(cat data.json)"
```
This command assumes that bin/console is the entry point for your Symfony commands and that you have a data.json file with the required data.

## Test from UI

To test the project from the UI, you can use the following URL:

```bash
  http://localhost:8080/api/doc
```

## Test from Postman

To test the project from Postman, you can use the following file:

```bash
  Check24.postman_collection.json
```


## Run Tests

To run tests and perform static analysis on the source code, follow these steps:

```bash
  docker compose exec php /bin/bash 
  bin/phpunit
  vendor/bin/phpstan analyse src 
```
