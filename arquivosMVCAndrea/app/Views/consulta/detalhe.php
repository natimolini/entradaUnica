<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Detalhes da Consulta</h1>
    <a href="/consulta/listar" class="btn-voltar">Voltar</a>
  </div>

  <?php if (isset($consulta)) : ?>
    <div class="detalhe-consulta">
      <p><strong>ID:</strong> <?= htmlspecialchars($consulta['id']) ?></p>
      <p><strong>Paciente:</strong> <?= htmlspecialchars($consulta['paciente_nome']) ?></p>
      <p><strong>Médico:</strong> <?= htmlspecialchars($consulta['medico_nome']) ?></p>
      <p><strong>Especialidade:</strong> <?= htmlspecialchars($consulta['especialidade_nome']) ?></p>
      <p><strong>Data:</strong> <?= htmlspecialchars($consulta['data']) ?></p>
      <p><strong>Hora:</strong> <?= htmlspecialchars($consulta['hora']) ?></p>
    </div>
  <?php else : ?>
    <p>Consulta não encontrada.</p>
  <?php endif; ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
