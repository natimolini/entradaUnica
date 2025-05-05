<?php // app/Views/usuario/editar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Editar Usuário</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <form action="/usuario/editar/<?= $usuario['id'] ?>" method="POST" class="formulario">
    <label for="usuario">Nome de Usuário:</label>
    <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>

    <label for="senha">Nova Senha:</label>
    <input type="password" id="senha" name="senha">

    <button type="submit" class="btn">Atualizar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
