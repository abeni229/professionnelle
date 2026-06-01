<?php

// Paramètres de connexion à la base de données
if (!defined('DB_HOST'))    define('DB_HOST', '127.0.0.1');
if (!defined('DB_NAME'))    define('DB_NAME', 'portfolio_roukayath');
if (!defined('DB_USER'))    define('DB_USER', 'root');
if (!defined('DB_PASS'))    define('DB_PASS', '');
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8mb4');

/**
 * Connexion PDO — retourne l'instance ou arrête avec un message d'erreur
 */
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHARSET
        );
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            // En production, ne jamais afficher le message brut
            error_log('DB Connection failed: ' . $e->getMessage());
            http_response_code(500);
            die(json_encode(['error' => 'Erreur de connexion à la base de données.']));
        }
    }

    return $pdo;
}