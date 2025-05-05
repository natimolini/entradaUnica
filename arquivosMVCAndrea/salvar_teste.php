<?php
session_start();
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

echo "<h2>Usuário recebido: $usuario</h2>";
echo "<h2>Senha recebida (não exibida por segurança)</h2>";
