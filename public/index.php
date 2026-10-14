<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use App\Controllers\UserController;

$config = require __DIR__ . '/../config/config.php';

// Route très simple pour l'instant
$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/' || str_contains($uri, '/users')) {
    $controller = new UserController();
    $controller->index();
} else {
    echo "404 - Page non trouvée";
}

