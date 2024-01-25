<?php

$server = 'localhost';
$user = 's5-gp2';
$mdp = 'p@1eHcW2*xJ$';
$base = 's5-gp2';
$port = '3306';

try {
    $pdo = new PDO("mysql:host=$server;port=$port;dbname=$base;charset=utf8",$user,$mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    echo $e->getMessage();
}

function get_result($requete){
    global $pdo;
    $requete = $pdo->query($requete);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function get_results($requete){
    global $pdo;
    $requete = $pdo->query($requete);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

?>