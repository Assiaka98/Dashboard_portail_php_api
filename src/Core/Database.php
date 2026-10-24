<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            // Inclusion du fichier de configuration s'il n'est pas déjà chargé
            if (!isset($GLOBALS['DB_CONFIG'])) {
                require_once __DIR__ . '/../../config/config.php';
            }

            $config = $GLOBALS['DB_CONFIG'];

            $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset={$config['db_charset']}";
            
            try {
                self::$instance = new PDO($dsn, $config['db_user'], $config['db_pass'], $config['db_options']);
            } catch (PDOException $e) {
                // Gestion propre de l'erreur de connexion
                throw new PDOException("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}