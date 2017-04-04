start:
	docker-compose up -d --force-recreate

stop:
	docker-compose stop

restart: stop start

php-logs:
	docker-compose logs -f php