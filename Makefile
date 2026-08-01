.PHONY: up down restart logs bash build


up:
	docker compose up -d --build


down:
	docker compose down


restart:
	docker compose restart


logs:
	docker compose logs -f


bash:
	docker compose exec php bash


build:
	docker compose build