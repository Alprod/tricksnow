# Tricksnow
![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)

---
Site communautaire pour les Snowborders

## Pour commencer

Telecharger la repository sur GitHub

-   HTTPS : ``https://github.com/Alprod/tricksnow.git``
-   SSH : ``git@github.com:Alprod/tricksnow.git``

S'assurer d'avoir Git installer sur sa machine

[![forthebadge](https://forthebadge.com/images/badges/contains-cat-gifs.svg)](https://forthebadge.com)

## Pré-requis

- Git
- Composer
- Docker
- Make

##Installation

Grace au makerfile une serie de command sera a votre disposition  

Initialisation du projet


**init** Inintialisation du projet  

Docker
---
- **start** - Lancer les conteneurs docker
- **stop** - Arréter les conteneurs docker  
- **rm** - Stop et supprimer les containeurs docker
- **restart** - redémarrer les conteneurs  
- **ssh-php** - Connexion au conteneur php  
- **docker-ps** - Status des conteneurs 

Symfony
---
- **vendor-install** - Installation des vendors  
- **vendor-update** - Mise à jour des vendors
- **clean-vendor** - Suppression du répertoire vendor puis un réinstall
- **cc** - Vider le cache
- **cc-test** - Vider le cache de l'environnement de test
- **cc-hard** - Supprimer le répertoire cache

DataBase 
---
- **create-db** - Création de la base de donnée
- **delete-db** - Supprimer la base de donnée
- **migrate-db** - Migration des données à la base de donnée
- **fake-data-db** - Charger de fausse données à la base de donnée
- **clean-db** - Réinitialiser la base de donnée
- **create-db-test** - Création de la base de donnée
- **clean-db-test** - Réinitialiser la base de donnée en environnement de test

Tests
---
- **test-unit** - Lancement des tests unitaire
- **test-func** - Lancement des tests fonctionnel
- **tests** -- Lancement de tous tests

Cleaner Code 
---
- **cs-fixer** - Lancement du php cs fixer
- **cbf** - Lancement du php cbf
- **cs** - Lancement du php cs

Others️ 
---
- **help** - Liste des commandes


Attention tout fois dans dockerfile oublier pas de modifier la derniére ligne,  
l’username a utilisé et celle de votre machine

``RUN addgroup --system <username> --gid 1000 && adduser --system <username> --uid 1000 --ingroup <username>``

Si vous utlisez Docker pour les commandes Symfony ```bin/console``` entrer dans le bash PHP docker,  
Si vous faite tout en local garder les commandes habituelle ```symfony console``` ou ``php bin/console``

## Fabriqué avec

Les programmes/logiciels/ressources que vous avez utilisées pour développer votre projet

-   [Bootstrap CDN](https://getbootstrap.com) - Framework CSS (front-end)
-   [PHPStorm](https://atom.io/) - IDE.

## Auteurs

-   **Germain Alain** _alias_ [@Alprod](https://github.com/Alprod)
