# Dashboard Portail - Systalink TEHORA
# Ancien projet: Gestion Utilisateur - Architecture MVC

> Évolution majeure : Passage d'une simple gestion d'utilisateurs à un Dashboard Portail complet pour TEHORA.

### Code de soumission : XJCECAYV (TerangaCode)

## Architecture du Projet - Dashboard Portail

Le projet a évolué vers une architecture portail modulaire :

- `public/` : Point d'entrée unique (front controller) - Lancement du portail
- `src/Controllers/` : Logique métier du Dashboard (UserController, AuthController, DashboardController, PostController)
- `src/Models/` : Modèles de données Portail (User, Post, Stats)
- `src/Core/` : Coeur du système - Database, Router
- `views/` , `routes/` , `config/` , `database/` , `frontend/`

Cette architecture permet d'étendre facilement vers les modules TEHORA (stats, posts, utilisateurs).

## Installation - Dashboard Portail

```bash
composer install
# Configurer la BDD dans config/config.php
# Importer user.sql et les nouvelles tables portail
php -S localhost:8000 -t public