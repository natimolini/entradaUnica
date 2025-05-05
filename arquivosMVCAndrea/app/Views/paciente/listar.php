<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Pacientes Cadastrados</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <?php if (!empty($pacientes)) : ?>
    <table class="tabela">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pacientes as $paciente) : ?>
          <tr>
            <td><?php echo htmlspecialchars($paciente['nome']); ?></td>
            <td><?php echo htmlspecialchars($paciente['data_nascimento']); ?></td>
            <td><?php echo htmlspecialchars($paciente['telefone']); ?></td>
            <td><?php echo htmlspecialchars($paciente['email']); ?></td>
            <td>
              <a href="/paciente/editar/<?php echo $paciente['id']; ?>" class="btn-acao">Editar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p>Nenhum paciente cadastrado ainda.</p>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
