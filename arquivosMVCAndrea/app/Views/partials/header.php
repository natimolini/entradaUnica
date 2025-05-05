<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clínica Médica</title>
  <link rel="stylesheet" href="/public/css/estilos.css">
  <link rel="stylesheet" href="/public/css/fullcalendar.css">
</head>
<body>
  <header class="cabecalho">
    <h1>Clínica Médica</h1>
    <?php if (isset($_SESSION['usuario'])): ?>
      <a href="/usuario/logout" class="btn-voltar">Sair</a>
    <?php endif; ?>
  </header>
  <main class="conteudo">


