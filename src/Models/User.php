<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class User {

    public static function getAll() {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Archiver : met l'état à 1 (archivé) et enregistre la date du jour
    public static function archive($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE users SET etat = 1, date_archive = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Désarchiver : remet l'état à 0 (actif) et efface la date d'archive
    public static function unarchive($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE users SET etat = 0, date_archive = NULL WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Mettre à jour le rôle de l'utilisateur
    public static function updateRole($id, $roleEtat) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE users SET role_etat = ? WHERE id = ?");
        return $stmt->execute([$roleEtat, $id]);
    }
}