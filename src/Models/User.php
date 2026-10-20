<?php
namespace App\Models;
use App\Core\Database;
use PDO;
//On dit à PHP où se trouve le fichier et on appelle ta connexion Database.php + PDO (l'outil sécurisé pour parler à MySQL).
class User {
    public static function all() {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }
    //il va chercher TOUS les utilisateurs.
    //SELECT * FROM users = donne-moi tout dans la table users. fetchAll = ramène tout sous forme de tableau
    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
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