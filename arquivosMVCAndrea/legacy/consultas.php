<?php
// consultas.php - API REST em PHP para gerenciamento de consultas
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("config.php"); // conecta ao banco

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    $sql = "SELECT c.id, c.dataHora,
                   p.nome AS paciente, m.nome AS medico, e.nome AS especialidade
            FROM consultas c
            JOIN pacientes p ON c.pacienteId = p.id
            JOIN medicos m ON c.medicoId = m.id
            JOIN especialidades e ON c.especialidadeId = e.id
            ORDER BY c.dataHora DESC";
    
    $res = $conn->query($sql);
    $dados = $res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($dados);
    break;

  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) {
      http_response_code(400);
      echo json_encode(["erro" => "JSON inválido"]);
      exit;
    }

    $stmt = $conn->prepare("INSERT INTO consultas (pacienteId, medicoId, especialidadeId, dataHora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $data['pacienteId'], $data['medicoId'], $data['especialidadeId'], $data['dataHora']);

    if ($stmt->execute()) {
      echo json_encode(["status" => "sucesso"]);
    } else {
      http_response_code(500);
      echo json_encode(["erro" => "Erro ao agendar consulta"]);
    }
    break;

  case 'PUT':
    $data = json_decode(file_get_contents("php://input"), true);
    parse_str($_SERVER['QUERY_STRING'], $params);
    $id = $params['id'] ?? null;

    if (!$id || !$data['dataHora']) {
      http_response_code(400);
      echo json_encode(["erro" => "Dados incompletos"]);
      exit;
    }

    $stmt = $conn->prepare("UPDATE consultas SET dataHora=? WHERE id=?");
    $stmt->bind_param("si", $data['dataHora'], $id);
    if ($stmt->execute()) {
      echo json_encode(["status" => "atualizado"]);
    } else {
      http_response_code(500);
      echo json_encode(["erro" => "Erro na atualização"]);
    }
    break;

  case 'DELETE':
    parse_str($_SERVER['QUERY_STRING'], $params);
    $id = $params['id'] ?? null;
    if (!$id) {
      http_response_code(400);
      echo json_encode(["erro" => "ID ausente"]);
      exit;
    }

    $stmt = $conn->prepare("DELETE FROM consultas WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
      echo json_encode(["status" => "excluido"]);
    } else {
      http_response_code(500);
      echo json_encode(["erro" => "Erro ao excluir"]);
    }
    break;

  default:
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
    break;
}

$conn->close();
