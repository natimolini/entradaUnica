<?php
require_once("config.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $res = $conn->query("SELECT m.id, m.nome, m.crm, e.nome AS especialidade, m.especialidadeId
                         FROM medicos m
                         JOIN especialidades e ON m.especialidadeId = e.id
                         ORDER BY m.nome");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data || !isset($data['nome'], $data['crm'], $data['especialidadeId'])) {
        http_response_code(400);
        echo json_encode(["erro" => "Dados incompletos"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO medicos (nome, crm, especialidadeId) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $data['nome'], $data['crm'], $data['especialidadeId']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "cadastrado"]);
    } else {
        http_response_code(500);
        echo json_encode(["erro" => "Erro ao cadastrar médico"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["erro" => "Método não permitido"]);
$conn->close();
