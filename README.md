# ping-stats
Network connection statistics

### Init
docker compose up -d

### Preparations For Local Run
docker compose exec app composer install --no-interaction --no-progress --optimize-autoloader

### Preparations
docker compose exec app php bin/console doctrine:database:create
docker compose exec app php bin/console doctrine:migrations:migrate -n

### Execute
docker compose exec app php bin/console run:monitor
