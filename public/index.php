<?php
/**
 * Point d'entrée unique (Front Controller) de l'API PHP pour Angular
 */

// 1. Gestion des en-têtes CORS (Permet à Angular sur http://localhost:4200 de communiquer avec PHP)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Réponse immédiate aux requêtes de pré-contrôle (Preflight OPTIONS du navigateur)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// 2. Chargement automatique des classes via Composer (pour les namespaces App\...)
require_once __DIR__ . '/../vendor/autoload.php';

// 3. Initialisation du Routeur
use App\Core\Router;

$router = new Router();

// 4. Inclusion des définitions de routes API
require_once __DIR__ . '/../routes/api.php';

// 5. Dispatch de la requête entrante
$router->dispatch();