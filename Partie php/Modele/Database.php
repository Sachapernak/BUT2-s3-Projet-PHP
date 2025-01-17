<?php
namespace Modele;

use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;
    private PDO $conn;


    private function __construct() {

        $host = 'mysql-handipromanager.alwaysdata.net';
        $db = 'handipromanager_bd';
        $user = '394731_app';
        $pass = 'TroisCacahuetesOrangesSur@UnCailloux$';
        $charset = 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
?>
