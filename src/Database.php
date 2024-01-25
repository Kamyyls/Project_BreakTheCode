<?php

// database.php

class Database {
    private $pdo;
    public function __construct($server, $port, $base, $user, $mdp) {
        try {
            $dsn = "mysql:host=$server;port=$port;dbname=$base;charset=utf8";
            $this->pdo = new PDO($dsn, $user, $mdp);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    public function getPdo() {
        return $this->pdo;
    }
}
