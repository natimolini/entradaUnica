<?php // app/Views/especialidade/listar.php ?>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Lista de Especialidades</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <table class="tabela">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($especialidades as $esp): ?>
        <tr>
          <td><?= $esp['id'] ?></td>
          <td><?= htmlspecialchars($esp['nome']) ?></td>
          <td>
            <a href="/especialidade/editar/<?= $esp['id'] ?>" class="btn-acao">✏️ Editar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php include __DIR__ . '/../partials/footer.php'; ?>

