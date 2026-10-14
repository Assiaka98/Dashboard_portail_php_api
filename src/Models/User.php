<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class User {
    public static function all() {
        $pdo = Database::getInstance();
        return $pdo->query("SELECT * FROM users
         WHERE archive = 0")->fetchAll();
    }

    public static function find($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function archive($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("UPDATE users SET archive = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}