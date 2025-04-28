<?php
require_once("config.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $res = $conn->query("SELECT * FROM pacientes ORDER BY nome");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data || !isset($data['nome'])) {
        http_response_code(400);
        echo json_encode(["erro" => "Dados incompletos"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO pacientes (nome, email, telefone, dataNascimento) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['nome'], $data['email'], $data['telefone'], $data['dataNascimento']);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "cadastrado"]);
    } else {
        http_response_code(500);
        echo json_encode(["erro" => "Erro ao cadastrar paciente"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["erro" => "Método não permitido"]);
$conn->close();