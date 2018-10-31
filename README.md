# OpenHandiTour
The OpenHandiTour is a graphql api which lists several places (monuments, leisure centers, castles, etc.) and makes suggestions for outings / visits to people with disabilities.

## Install application
* Install Docker => https://docs.docker.com/docker-for-mac/install/
* Init containers `docker-compose up -d --build`

## Graph API
* Launch container `make web`
* Install vendors `composer install`
* Init DB: `bin/console doctrine:schema:create`
* Load fixtures: `bin/console doctrine:fixtures:load`

## Postgresql DB Client
* Launch psql with `make db`

## URL
* http://127.0.0.1

## Example Queries
* https://gist.github.com/Paoola/342797b7022ff8d732e2eeee222a64cb
