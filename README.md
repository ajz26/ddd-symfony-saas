
# Credit Cards API

## Description

This is a simple API to get credit cards information from financeads.

## Installation

docker compose up -d --build

docker exec -it php composer install

docker exec -it php bin/console doctrine:migrations:migrate

## Usage

for use async mode need to run this command

docker exec -it php bin/console messenger:consume async --limit=100

### Sync Cards

for sync cards can use async mode or sync mode with this command

docker exec -it php bin/console app:sync-cards **OR** docker exec -it php bin/console app:sync-cards --async for async mode

or access to [GET|POST]http://localhost/api/v1/cards/sync

### Get Cards

for get cards can access to http://localhost/api/v1/cards