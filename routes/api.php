<?php
use App\Controllers\ApiUserController;
use App\Controllers\ApiHealthController;

// Route de test de l'état de l'API
$router->get('/api/health', [ApiHealthController::class, 'check']);

// Routes de gestion des utilisateurs (REST / JSON)
$router->get('/api/users', [ApiUserController::class, 'index']);          // Liste tous les utilisateurs actifs
$router->get('/api/users/{id}', [ApiUserController::class, 'show']);      // Affiche un utilisateur spécifique
$router->post('/api/users', [ApiUserController::class, 'store']);         // Crée un utilisateur
$router->put('/api/users/{id}', [ApiUserController::class, 'update']);    // Met à jour un utilisateur
$router->delete('/api/users/{id}', [ApiUserController::class, 'archive']); // Soft delete (Archivage)
// Soft delete : Archive l'utilisateur au lieu de le supprimer de la BDD
