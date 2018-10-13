# OpenHandiTour
The OpenHandiTour application repository

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
