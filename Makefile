.PHONY: up down build cs test analyse
.DEFAULT_GOAL := up

# start all services
up:
	docker-compose up -d --remove-orphans
# stop service
down:
	docker-compose down --remove-orphans
# restart with rebuild
build: down
	docker-compose up -d --build
# php code style fix
cs:
	docker exec app_php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v --using-cache=no
# php code style check
cs.check:
	docker exec app_php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php -v --using-cache=no --dry-run
# run phpstan
analyse:
	docker exec app_php vendor/bin/phpstan analyse
# run tests
test: migrate.test
	docker exec app_php vendor/bin/codecept run
# go into container
t:
	gnome-terminal -- bash -c 'docker exec -it app_php bash'
# apply migrations
migrate:
	docker exec app_php php yii migrate/up
# apply migrations on test db
migrate.test:
	docker exec app_php php tests/bin/yii migrate/up