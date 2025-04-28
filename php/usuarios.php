<?php
// Importa a configuração de conexão com o banco de dados
require_once 'config.php';

// Função para limpar entrada
function limparEntrada($entrada) {
  return htmlspecialchars(trim($entrada));
}

// Captura e limpa os dados do formulário
$usuario = limparEntrada($_POST['usuario']);
$senha = limparEntrada($_POST['senha']);
$confirmarSenha = limparEntrada($_POST['confirmar_senha']);

// Valida se as senhas coincidem
if ($senha !== $confirmarSenha) {
  echo "<script>alert('As senhas não coincidem.'); window.history.back();</script>";
  exit;
}

// Verifica se o usuário já existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  echo "<script>alert('Usuário já existe. Escolha outro.'); window.history.back();</script>";
  exit;
}
$stmt->close();

// Insere o novo usuário
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $senhaHash);

if ($stmt->execute()) {
  echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = '../login.html';</script>";
} else {
  echo "<script>alert('Erro ao cadastrar usuário.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
