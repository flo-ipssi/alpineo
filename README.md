# Projet Symfony - Movie Database Service

Ce projet est une application Symfony qui interagit avec une API de base de données de films (TMDb). Il utilise Docker pour l'environnement de développement et PHPUnit pour les tests.

## Prérequis

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

## Installation

### Cloner le dépôt

```bash
git clone https
cd app
```

### Installer les dépendances

```bash
composer install
npm install
```

## Utilisation

### Lancer l'application

```bash
docker-compose up -d
    
# Ou

docker-compose up -d --build
```

### Accéder à l'application

L'application est accessible à l'adresse `http://localhost:808`.

## Tests

Les tests sont écrits avec PHPUnit et utilisent Docker pour l'environnement de développement.