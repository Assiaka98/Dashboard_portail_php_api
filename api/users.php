<?php
// API Sécurisée - Validée TerangaCode XJCECAYV
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

require __DIR__ . '/../config/config.php';

try {
    $pdo = getDB();
    
    // Requête sécurisée - on ne renvoie jamais le password
    $stmt = $pdo->query("SELECT id, nom, email FROM users ORDER BY id DESC LIMIT 50");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Nettoyage des données pour l'affichage
    $clean_users = [];
    foreach ($users as $u) {
        $clean_users[] = [
            'id' => (int)$u['id'],
            'nom' => $u['nom'],
            `prenom` => $u['prenom'],
            'email' => $u['email'],
            `role` => $u['role']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($clean_users),
        'data' => $clean_users,
        'api_version' => '1.0 - Systalink Ready'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur serveur',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}