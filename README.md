# API Bibliothèque 📚

API REST de gestion d’une bibliothèque en ligne, réalisée avec Symfony et API Platform dans le cadre d’un projet pédagogique.

## Technologies

- PHP / Symfony
- API Platform
- Doctrine ORM
- Authentification JWT avec LexikJWTAuthenticationBundle

## Fonctionnalités prévues

- Inscription et connexion avec un token JWT.
- Consultation des livres et des auteurs.
- Ajout, modification et suppression des livres et des auteurs pour les utilisateurs connectés.
- Recherche de livres par titre, auteur ou genre.
- Consultation des livres ajoutés au cours des 7 derniers jours.
- Contrôle des données exposées grâce aux groupes de sérialisation.
- Documentation interactive avec Swagger UI.

## Installation

### 1. Cloner le dépôt

```bash
git clone <URL_DU_DEPOT>
cd <NOM_DU_PROJET>
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l’environnement

Créer un fichier `.env.local` et y renseigner la connexion à la base de données :

```dotenv
DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/bibliotheque"
```

Adapter les identifiants à votre environnement et configurer les variables JWT utilisées par le projet.

### 4. Préparer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Générer les clés JWT

```bash
php bin/console lexik:jwt:generate-keypair
```

### 6. Lancer le serveur

```bash
symfony serve
```

## Documentation de l’API

Une fois le serveur lancé, accéder à `/api` depuis l’adresse locale indiquée dans le terminal pour consulter la documentation et tester les endpoints.

## Objectif du projet

Apprendre à développer une API REST avec Symfony : gestion des relations entre les entités, authentification JWT, filtres, validation et sérialisation des données.
