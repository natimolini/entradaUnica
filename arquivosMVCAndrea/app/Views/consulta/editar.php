<?php // app/Views/consulta/editar.php ?>
<!DOCTYPE html>
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Editar Consulta</h1>
    <a href="/consulta/listar" class="btn-voltar">Voltar</a>
  </div>

  <form action="/consulta/editar/<?php echo $consulta['id']; ?>" method="POST" class="formulario">
    <label for="data">Data da consulta:</label>
    <input type="date" id="data" name="data" value="<?php echo htmlspecialchars($consulta['data']); ?>" required>

    <label for="hora">Hora da consulta:</label>
    <input type="time" id="hora" name="hora" value="<?php echo htmlspecialchars($consulta['hora']); ?>" required>

    <button type="submit" class="btn">Atualizar Consulta</button>
  </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

