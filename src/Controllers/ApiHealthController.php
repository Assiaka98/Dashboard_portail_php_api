<?php
namespace App\Controllers;

class ApiHealthController {
    public function check() {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'status' => 'success',
            'message' => 'API opérationnelle'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}