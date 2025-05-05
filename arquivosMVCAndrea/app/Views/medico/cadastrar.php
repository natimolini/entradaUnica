<?php // app/Views/medico/cadastrar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Cadastrar Médico</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <form action="/medico/cadastrar" method="POST" class="formulario">
    <label for="nome">Nome do Médico:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="crm">CRM:</label>
    <input type="text" id="crm" name="crm" required>

    <label for="especialidade_id">Especialidade:</label>
    <select id="especialidade_id" name="especialidade_id" required>
      <?php foreach ($especialidades as $esp): ?>
        <option value="<?= $esp['id'] ?>"><?= htmlspecialchars($esp['nome']) ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit" class="btn">Salvar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
