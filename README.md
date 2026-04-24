# TaskList Symfony

[![Symfony](https://img.shields.io/badge/Symfony-6.x-black?logo=symfony)](https://symfony.com/)
[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php)](https://www.php.net/)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?logo=tailwindcss)](https://tailwindcss.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)]()

Petit projet **TaskList** développé avec Symfony afin de m’entraîner sur le framework et la création d’une application CRUD complète.

---

## Aperçu

![App Screenshot](./docs/screenshot.png)


---


## Fonctionnalités

- Création, modification et suppression de tâches
- Gestion des statuts (à faire / en cours / terminé)
- Filtrage des tâches
- Organisation par catégories ou priorités (si présent dans ton projet)
- Interface responsive avec Tailwind CSS
- Système de fixtures pour générer des données de test

---

## Stack technique

- Symfony (Framework PHP)
- PHP 8+
- Tailwind CSS
- Doctrine ORM
- SQLite
- Composer

---

## Installation

Cloner le projet :

```bash
git clone https://github.com/Fraxoo/tasklist-symfony.git
cd tasklist-symfony
```

Installer les dépendances PHP :

```bash
composer install
```

Créer la base de données et exécuter les migrations :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

---

## Lancer le projet

Démarrer le serveur Symfony :

```bash
symfony server:start
```

Compiler Tailwind en mode watch :

```bash
symfony console tailwind:build --watch
```

---

## Structure du projet

```bash
src/
 ├── Controller/
 ├── Entity/
 ├── Repository/
 ├── DataFixtures/
templates/
 ├── task/
 ├── base.html.twig
```




## Auteur

**John Hardy** — [@Fraxoo](https://github.com/Fraxoo)