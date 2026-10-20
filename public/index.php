<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use App\Controllers\UserController;

$config = require __DIR__ . '/../config/config.php';

// Route très simple pour l'instant
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

if ($uri === '' || $uri === '/' || $uri === '/projets/Gestion_Utilisateur_V2/public' || str_contains($uri, '/users') || str_contains($uri, '/public')) {
    $controller = new UserController();
    $controller->index();
} else {
    echo "404 - Page non trouvée - URI: " . $uri;
}