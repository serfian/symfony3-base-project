## base_project

This is the base project to be used for all the SingleHop projects.

Go to [http://devwiki.singlehop.net/index.php?title=Base_Projects SingleHop Dev Wiki] to find latest information on how to use this project .

This project is based on the Symfony 3.3 with bundles pre chosen to create a REST application.

Used bundles: prooph, Nelmio ApiDoc, FosREST, FosElastica and RabbitMQ.

Execute bin/console server:start to start the current demo application.


## Requirements


* php: 7.0 version or higher

## BaseProject


project description


## Applications Supported


Required Application and version numbers

[https://github.com/Smart-Core/AcceleratorCacheBundle Cache Bundle]

## Install

Sql queries 
``` 
CREATE DATABASE {PROJECT_DB_SCHEMA};
GRANT ALL PRIVILEGES ON SCHEMA {PROJECT_DB_NAME} TO {PROJECT_DB_USERNAME};    
```
Event stream
```
php bin/console doctrine:migrations:migrate
php bin/console event_stream:table:create {STREAM_NAME}
```

## Deployment

Environment variables

```
    SYMFONY__APP__NAME="Base Project"
    SYMFONY__CURRENT__API__VERSION=1
    SYMFONY__DATABASE__HOST=
    SYMFONY__DATABASE__DRIVER=pdo_pgsql
    SYMFONY__DATABASE__PORT=
    SYMFONY__DATABASE__NAME=
    SYMFONY__DATABASE__USER=
    SYMFONY__DATABASE__PASSWORD=
    SYMFONY__DATABASE__VERSION=
    SYMFONY__DATABASE__SSL_MODE=
    SYMFONY__DATABASE__SSL_ROOT_CERT=
    SYMFONY__DATABASE__APPLICATION_NAME=
    SYMFONY__ELASTICSEARCH__HOST=
    SYMFONY__LOCALE=en
    SYMFONY__PROJECT_URL=
    SYMFONY__RABBITMQ__HOST=
    SYMFONY__RABBITMQ__PORT=5672
    SYMFONY__RABBITMQ__USER=
    SYMFONY__RABBITMQ__PASSWORD=
    SYMFONY__RABBITMQ__VHOST=dev
    SYMFONY__RABBITMQ__EXCHANGE__EVENT=
    SYMFONY__RABBITMQ__QUEUE__EVENT=
    SYMFONY__RBAC__HOST=
    SYMFONY__RBAC__PROTOCOL=https
    SYMFONY__RBAC__CONNECT__PATH=v1/connect
    SYMFONY__SERVICE__CLIENT_ID=
    SYMFONY__SERVICE__CLIENT_SECRET=
    SYMFONY__SECRET=    
```

## Usage

Base bundle can be used for acquaintance with prooph.