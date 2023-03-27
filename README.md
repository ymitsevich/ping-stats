# ping-stats
Network connection statistics.
Monitors connectivity with a certain host and stores results into DB.
Sqlite as a default DB is used.

### Tech description
Docker, SQLite, Github Actions, Unit tests

## Dev
### Init
make build-dev

### Preparations
make init
make composer

### Execute
make dev

## Prod
### Init
make build-prod

### Preparations
make init

### Execute
make prod

## Running Tests
make test
