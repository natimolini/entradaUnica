<?php // app/Views/medico/listar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Lista de Médicos</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <table class="tabela">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CRM</th>
        <th>Especialidade</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($medicos as $medico): ?>
        <tr>
          <td><?= $medico['id'] ?></td>
          <td><?= htmlspecialchars($medico['nome']) ?></td>
          <td><?= htmlspecialchars($medico['crm']) ?></td>
          <td><?= htmlspecialchars($medico['especialidade_nome']) ?></td>
          <td>
            <a href="/medico/editar/<?= $medico['id'] ?>" class="btn-acao">✏️ Editar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php include __DIR__ . '/../partials/footer.php'; ?>
