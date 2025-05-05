<?php // app/Views/consulta/cadastrar.php ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Agendar Consulta</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <form action="/consulta/cadastrar" method="POST" class="formulario">
    <label for="paciente_id">Paciente:</label>
    <select name="paciente_id" id="paciente_id" required>
      <!-- Options devem ser preenchidas com dados do controller -->
    </select>

    <label for="medico_id">Médico:</label>
    <select name="medico_id" id="medico_id" required>
      <!-- Options devem ser preenchidas com dados do controller -->
    </select>

    <label for="data">Data:</label>
    <input type="date" name="data" id="data" required>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" id="hora" required>

    <button type="submit" class="btn">Agendar</button>
  </form>

<?php include __DIR__ . '/partials/footer.php'; ?>
