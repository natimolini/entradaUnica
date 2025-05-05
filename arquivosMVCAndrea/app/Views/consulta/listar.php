<?php // app/Views/consulta/listar.php ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Consultas Agendadas</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <?php if (!empty($consultas)) : ?>
    <table class="tabela">
      <thead>
        <tr>
          <th>ID</th>
          <th>Paciente</th>
          <th>Médico</th>
          <th>Data</th>
          <th>Hora</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($consultas as $consulta) : ?>
          <tr>
            <td><?= htmlspecialchars($consulta['id']) ?></td>
            <td><?= htmlspecialchars($consulta['paciente_nome']) ?></td>
            <td><?= htmlspecialchars($consulta['medico_nome']) ?></td>
            <td><?= htmlspecialchars($consulta['data']) ?></td>
            <td><?= htmlspecialchars($consulta['hora']) ?></td>
            <td>
              <a href="/consulta/editar/<?= $consulta['id'] ?>" class="btn-acao">Editar</a>
              <a href="/consulta/detalhar/<?= $consulta['id'] ?>" class="btn-acao">Detalhar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p>Nenhuma consulta agendada.</p>
  <?php endif; ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
