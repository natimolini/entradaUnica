<?php // app/Views/especialidade/cadastrar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Cadastrar Especialidade</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <form action="/especialidade/cadastrar" method="POST" class="formulario">
    <label for="nome">Nome da Especialidade:</label>
    <input type="text" id="nome" name="nome" required>

    <button type="submit" class="btn">Salvar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
