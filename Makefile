.PHONY: up run down restart build reset.cache test analyse
.DEFAULT_GOAL := run

# start all services
run:
	docker-compose up -d --remove-orphans
up:
	docker-compose up -d --remove-orphans
# stop service
down:
	docker-compose down
# restart
restart: | down run
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
# go into container
t:
	gnome-terminal -- bash -c 'docker exec -it app_php bash'