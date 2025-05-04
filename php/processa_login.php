<?php
session_start();
require_once 'config.php'; // Este arquivo deve conter a conexão com o banco

function limparEntrada($entrada) {
  return htmlspecialchars(trim($entrada));
}

// Verifica se os campos foram enviados
if (isset($_POST['usuario'], $_POST['senha'])) {
    $usuario = limparEntrada($_POST['usuario']);
    $senha = limparEntrada($_POST['senha']);

    // Prepara e executa a consulta
    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    // Verifica se encontrou o usuário
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $senhaHash);
        $stmt->fetch();

        // Verifica a senha
        if (password_verify($senha, $senhaHash)) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $usuario;

            // Redireciona para a área protegida
            header("Location: ../dashboard.html");
            exit;
        } else {
            echo "<script>alert('Senha incorreta.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Dados incompletos.'); window.history.back();</script>";
}
?>
