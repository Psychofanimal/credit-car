SHELL=/bin/bash

start: up ## поднимает среду
up: ## запускает docker сервисы для prod среды
	docker compose up -d --remove-orphans
up-dev: ## запускает docker сервисы для dev среды
	docker compose -f docker-compose-dev.yaml up -d --remove-orphans
up-web: ## запускает web сервер для работы api
	docker compose -f docker-compose-web.yaml up -d
stop: ## останавливает сервисы
	docker compose stop --timeout 5
down: ## останавливает и удаляет контейнеры, сети
	docker compose down