<?php
namespace App\Models;
use App\Core\Database;
use PDO;
//On dit à PHP où se trouve le fichier et on appelle ta connexion Database.php + PDO (l'outil sécurisé pour parler à MySQL).
class User {
public static function getAll() {
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public static function find($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ? AND date_archive IS NULL");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    //il va chercher TOUS les utilisateurs actifs.
    //SELECT * FROM users = donne-moi tout dans la table users. fetchAll = ramène tout sous forme de tableau
   public static function archive($id) {
    global $pdo; // Assurez-vous que $pdo est accessible, ou utilisez votre classe Database
    if (!$pdo) {
        // Ajustez selon votre façon de récupérer PDO (ex: Database::getConnection())
        $pdo = \App\Core\Database::getConnection(); 
    }
    $stmt = $pdo->prepare("UPDATE users SET date_archive = NOW() WHERE id = ?");
    return $stmt->execute([$id]);
}

public static function unarchive($id) {
    global $pdo;
    if (!$pdo) {
        $pdo = \App\Core\Database::getConnection();
    }
    $stmt = $pdo->prepare("UPDATE users SET date_archive = NULL WHERE id = ?");
    return $stmt->execute([$id]);
}
    /*supprime un user. 
    prepare("... ?") + execute([$id]) = sécurité. Ça évite les injections SQL. 
    Si un hacker met 1 OR 1=1, ça ne supprimera pas toute la base. Le ? protège.*/
    public static function create($nom, $email) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO users (nom, email) VALUES (?, ?)");
        return $stmt->execute([$nom, $email]);
    }
    /**ajoute un nouvel utilisateur. 
INSERT INTO = ajoute une ligne. Encore avec ? ? pour sécuriser le nom et l'email qui viennent du formulaire. */
}