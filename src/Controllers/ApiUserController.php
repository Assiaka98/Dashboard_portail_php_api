<?php
namespace App\Controllers;

use App\Models\User;

class ApiUserController {
    // ... (votre méthode index existante)
public function index() {
    header('Content-Type: application/json; charset=utf-8');
    try {
        $users = User::getAll(); // Récupère tous les utilisateurs
        echo json_encode([
            "status" => "success",
            "data" => $users
        ], JSON_UNESCAPED_UNICODE);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
} 
    public function show($id) {
        header('Content-Type: application/json; charset=UTF-8');
        try {
            $user = User::find($id); 

            if ($user) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $user
                ], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => "Utilisateur introuvable."
                ], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
    public function archive($id) {
    header('Content-Type: application/json; charset=UTF-8');
    try {
        $archived = User::archive($id);

        if ($archived) {
            echo json_encode([
                'status' => 'success',
                'message' => "Utilisateur avec l'ID {$id} archivé avec succès."
            ], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => "Utilisateur introuvable."
            ], JSON_UNESCAPED_UNICODE);
        }
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
    }
    exit;
    }
    public function updateRole($id) {
    header('Content-Type: application/json; charset=UTF-8');
    $data = json_decode(file_get_contents('php://input'), true);
    $roleEtat = $data['role_etat'] ?? 1;

    // Logique de mise à jour en base de données pour l'utilisateur $id
    // User::updateRole($id, $roleEtat);

    echo json_encode([
        'status' => 'success',
        'message' => 'Rôle mis à jour avec succès.'
    ]);
    exit;
    }
}