# credit-car

### Start on dev environment
make up-web
make up-dev

### Start on prod environment
make up

### Down containers
make down

## Build Docker images

### PHP image pull
docker build --platform linux/amd64 -t ghcr.io/psychofanimal/credit-car/php:latest -f .docker/php/Dockerfile . &&
docker push ghcr.io/psychofanimal/credit-car/php:latest
### Database image pull
docker build --platform linux/amd64 -t ghcr.io/psychofanimal/credit-car/database:latest -f .docker/db/Dockerfile . &&
docker push ghcr.io/psychofanimal/credit-car/database:latest

## Traefik
### Dashboard
https://api.docker.ru/dashboard/#/ 