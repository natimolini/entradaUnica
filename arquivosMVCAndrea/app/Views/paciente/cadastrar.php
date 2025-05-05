<?php // app/Views/paciente/cadastrar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Cadastrar Paciente</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <form action="/paciente/cadastrar" method="POST" class="formulario">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" required>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" required>

    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit" class="btn">Salvar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
