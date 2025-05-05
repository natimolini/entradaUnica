<?php // app/Views/paciente/editar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Editar Paciente</h1>
    <a href="/paciente/listar" class="btn-voltar">Voltar</a>
  </div>

  <form action="/paciente/editar/<?php echo $paciente['id']; ?>" method="POST" class="formulario">
    <label for="nome">Nome completo:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($paciente['nome']); ?>" required>

    <label for="data_nascimento">Data de nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($paciente['data_nascimento']); ?>" required>

    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($paciente['telefone']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($paciente['email']); ?>">

    <button type="submit" class="btn">Atualizar</button>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

