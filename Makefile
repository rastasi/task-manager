dev:
	docker compose up
migrate:
	docker compose exec api php artisan migrate
seed:
	docker compose exec api php artisan db:seed