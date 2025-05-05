<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Teste de Cadastro</title>
</head>
<body>
    <h1>Formulário de Cadastro - Teste Isolado</h1>
    <form action="salvar_teste.php" method="POST">
        <label>Usuário:</label>
        <input type="text" name="usuario"><br>

        <label>Senha:</label>
        <input type="password" name="senha"><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>

