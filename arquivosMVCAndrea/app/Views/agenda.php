<?php // app/Views/agenda.php ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Agenda da Clínica</h1>
    <a href="/dashboard" class="btn-voltar">Voltar</a>
  </div>

  <div id="calendario"></div>
</div>

<!-- Script específico do calendário (FullCalendar) -->
<script src="/public/js/sistema.js"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
