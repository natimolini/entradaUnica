<?php // app/Views/especialidade/editar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Editar Especialidade</h1>
    <a href="/especialidade/listar" class="btn-voltar">Voltar</a>
  </div>

  <form action="/especialidade/editar/<?= $especialidade['id'] ?>" method="POST" class="formulario">
    <label for="nome">Nome da Especialidade:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($especialidade['nome']) ?>" required>

    <button type="submit" class="btn">Atualizar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>

