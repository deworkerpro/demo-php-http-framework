init: docker-down-clear docker-pull docker-build-pull docker-up app-init
down: docker-down-clear
check: lint analyze test

docker-up:
	docker-compose up -d

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build-pull:
	docker-compose build --pull

app-init: composer-install

composer-install:
	docker-compose run --rm php-cli composer install

lint:
	docker-compose run --rm php-cli composer php-cs-fixer fix -- --dry-run --diff

cs-fix:
	docker-compose run --rm php-cli composer php-cs-fixer fix

analyze:
	docker-compose run --rm php-cli composer psalm -- --no-diff

test:
	docker-compose run --rm php-cli composer test
