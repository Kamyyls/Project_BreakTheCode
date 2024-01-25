<?php
class Database
{
    private $pdo;
    private $server = 'localhost';
    private $user = 's5-gp2';
    private $mdp = 'p@1eHcW2*xJ$';
    private $base = 's5-gp2';
    private $port = '3306';
    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->server;port=$this->port;dbname=$this->base;charset=utf8";
            $this->pdo = new PDO($dsn, $this->user, $this->mdp);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function getPDO(){
        return $this->pdo;
    }

}
