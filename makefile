.PHONY: help
.DEFAULT_GOAL = help

DOCKER_COMPOSE=@docker-compose
DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE) exec
PHP_DOCKER_COMPOSE_EXEC=$(DOCKER_COMPOSE_EXEC) php
COMPOSER=$(PHP_DOCKER_COMPOSE_EXEC) php -d memory_limit=-1 /usr/local/bin/composer
SYMFONY_CONSOLE=$(PHP_DOCKER_COMPOSE_EXEC) bin/console

init: vendor-install start create-db delete-db migrate-db fake-data-db 	## Inintialisation du projet

## —— Docker ------------------------------------------------------------------------------
start:	## Lancer les containers docker
	$(DOCKER_COMPOSE) up -d

stop:	## Arréter les containers docker
	$(DOCKER_COMPOSE) stop

rm:	stop ## Supprimer les containers docker
	$(DOCKER_COMPOSE) rm -f

restart: rm start	## redémarrer les containers

ssh-php:	## Connexion au container php
	$(PHP_DOCKER_COMPOSE_EXEC) bash

docker-ps:	## Status des containers
	$(DOCKER_COMPOSE) ps

## —— Symfony -----------------------------------------------------------------------------
vendor-install:	## Installation des vendors
	$(COMPOSER) install

vendor-update:	## Mise à jour des vendors
	$(COMPOSER) update

clean-vendor: cc-hard ## Suppression du répertoire vendor puis un réinstall
	$(PHP_DOCKER_COMPOSE_EXEC) rm -Rf vendor
	$(PHP_DOCKER_COMPOSE_EXEC) rm composer.lock
	$(COMPOSER) install

cc:	## Vider le cache
	$(SYMFONY_CONSOLE) c:c

cc-test:	## Vider le cache de l'environnement de test
	$(SYMFONY_CONSOLE) c:c --env=test

cc-hard: ## Supprimer le répertoire cache
	$(PHP_DOCKER_COMPOSE_EXEC) rm -fR var/cache/*

## —— DataBase -------------------------------------------------------------------------------
create-db: ## Création de la base de donnée
	$(SYMFONY_CONSOLE) d:d:c

delete-db: ## Supprimer la base de donnée
	$(SYMFONY_CONSOLE) d:d:d --force --connection

migrate-db: ## Migration des données à la base de donnée
	$(SYMFONY_CONSOLE) d:m:m --no-interaction

fake-data-db: ## Charger de fausse données à la base de donnée
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

clean-db: ## Réinitialiser la base de donnée
	- $(SYMFONY_CONSOLE) d:d:d --force --connection
	$(SYMFONY_CONSOLE) d:d:c
	$(SYMFONY_CONSOLE) d:m:m --no-interaction
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

create-db-test: ## Création de la base de donnée
	$(SYMFONY_CONSOLE) d:d:c --env=test

clean-db-test: cc-hard cc-test ## Réinitialiser la base de donnée en environnement de test
	- $(SYMFONY_CONSOLE) d:d:d --force --env=test
	$(SYMFONY_CONSOLE) d:d:c --env=test
	$(SYMFONY_CONSOLE) d:m:m --no-interaction --env=test
	$(SYMFONY_CONSOLE) d:f:l --no-interaction --env=test

## —— Tests -------------------------------------------------------------------------------
test-unit: ## Lancement des tests unitaire
	$(PHP_DOCKER_COMPOSE_EXEC) bin/phpunit tests/Unit/

test-func: clean-db-test	## Lancement des tests fonctionnel
	$(PHP_DOCKER_COMPOSE_EXEC) bin/phpunit tests/Func/

tests: test-func test-unit	## Lancement de tous tests

## —— Cleaner Code ------------------------------------------------------------------------
cs-fixer: ## Lancement du php cs fixer
	$(PHP_DOCKER_COMPOSE_EXEC) vendor/bin/php-cs-fixer fix

cbf: ## Lancement du php cbf
	$(PHP_DOCKER_COMPOSE_EXEC) vendor/bin/phpcbf

cs: ## Lancement du php cs
	$(PHP_DOCKER_COMPOSE_EXEC) vendor/bin/phpcs -n

## —— Others️ ------------------------------------------------------------------------------
help: ## Liste des commandes
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
