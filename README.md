# Gestion Utilisateur - Architecture MVC

Système de gestion d'utilisateurs sécurisé, refactorisé d'une architecture PHP procédurale legacy vers une architecture MVC propre.

### Stack Technique
- PHP 8+, Composer (PSR-4 Autoload)
- PDO, MySQL
- Authentification par rôles (Admin / Utilisateur)
- Gestion des archives, pagination

### Architecture du Projet
- `public/` : Point d'entrée unique (front controller)
- `src/Controllers/` : Logique métier (UserController, AuthController)
- `src/Models/` : Modèles de données
- `src/Core/` : Database, Router
- `views/`, `routes/`, `config/`

### Installation
```bash
composer install
# Configurer la BDD dans config/config.php
# Importer useri.sql
php -S localhost:8000 -t public
