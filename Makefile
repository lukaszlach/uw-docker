build:
	docker-compose pull
	docker-compose build

start: stop
	docker-compose up -d batch-body-crawler

stop:
	docker-compose stop

kill:
	docker-compose kill

restart: stop start

logs:
	docker-compose logs -f batch-body-crawler

php-logs:
	docker-compose logs -f