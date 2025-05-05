<?php
// config.php - Conexão PDO com banco de dados MySQL
$host = 'localhost';
$db   = 'clinica_medica';
$user = 'clinica';
$pass = 'M!nh@senhA1985';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die('Erro ao conectar: ' . $e->getMessage());
}
