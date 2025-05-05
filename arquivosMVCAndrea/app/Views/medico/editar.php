<?php // app/Views/medico/editar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Editar Médico</h1>
    <a href="/medico/listar" class="btn-voltar">Voltar</a>
  </div>

  <form action="/medico/editar/<?= $medico['id'] ?>" method="POST" class="formulario">
    <label for="nome">Nome do Médico:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($medico['nome']) ?>" required>

    <label for="crm">CRM:</label>
    <input type="text" id="crm" name="crm" value="<?= htmlspecialchars($medico['crm']) ?>" required>

    <label for="especialidade_id">Especialidade:</label>
    <select id="especialidade_id" name="especialidade_id" required>
      <?php foreach ($especialidades as $esp): ?>
        <option value="<?= $esp['id'] ?>" <?= $esp['id'] == $medico['especialidade_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($esp['nome']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <button type="submit" class="btn">Atualizar</button>
  </form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
