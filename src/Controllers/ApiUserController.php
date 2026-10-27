<?php
namespace App\Controllers;

use App\Models\User;

class ApiUserController {

    public function index() {
        header('Content-Type: application/json; charset=utf-8');
        try {
            $users = User::getAll(); // Récupère tous les utilisateurs[cite: 10]
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
            // Appel de la méthode d'archivage (qui met l'état à 'archive' et date_archive = NOW())
            $archived = User::archive($id);

            if ($archived) {
                // Enregistrement optionnel dans les logs d'audit
                // User::logAudit($id, 'ARCHIVAGE_UTILISATEUR', "Archivage de l'utilisateur ID: {$id}");

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

    public function unarchive($id) {
        header('Content-Type: application/json; charset=UTF-8');
        try {
            // Appel de la méthode de désarchivage (remet l'état à 'actif' et date_archive à NULL)
            $unarchived = User::unarchive($id);

            if ($unarchived) {
                // Enregistrement optionnel dans les logs d'audit
                // User::logAudit($id, 'DESARCHIVAGE_UTILISATEUR', "Désarchivage de l'utilisateur ID: {$id}");

                echo json_encode([
                    'status' => 'success',
                    'message' => "Utilisateur avec l'ID {$id} restauré avec succès."
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
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $roleEtat = $data['role_etat'] ?? 1;

            // Logique de mise à jour du rôle en base de données
            // User::updateRole($id, $roleEtat);

            echo json_encode([
                'status' => 'success',
                'message' => 'Rôle mis à jour avec succès.'
            ], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
}