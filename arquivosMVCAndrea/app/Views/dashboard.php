<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: /usuario/login');
    exit;
}
echo "Sessão iniciada com sucesso. Usuário: " . $_SESSION['usuario'];
?>

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container">
  <div class="header-pagina">
    <h1>Dashboard</h1>
    <a href="/usuario/logout" class="btn-voltar">Sair</a>
  </div>

  <div class="grid-opcoes">

    <a href="/agenda" class="card-opcao">
      <div class="icone">📅</div>
      <div class="texto">
        <h3>Ver Agenda</h3>
        <p>Visualizar todas as consultas agendadas.</p>
      </div>
    </a>

    <a href="/consulta/cadastrar" class="card-opcao">
      <div class="icone">➕</div>
      <div class="texto">
        <h3>Agendar Consulta</h3>
        <p>Marcar nova consulta para paciente.</p>
      </div>
    </a>

    <a href="/paciente/cadastrar" class="card-opcao">
      <div class="icone">👤</div>
      <div class="texto">
        <h3>Novo Paciente</h3>
        <p>Cadastrar novos pacientes no sistema.</p>
      </div>
    </a>

    <a href="/medico/cadastrar" class="card-opcao">
      <div class="icone">🩺</div>
      <div class="texto">
        <h3>Novo Médico</h3>
        <p>Adicionar médicos e suas especialidades.</p>
      </div>
    </a>

    <a href="/especialidade/cadastrar" class="card-opcao">
      <div class="icone">📚</div>
      <div class="texto">
        <h3>Nova Especialidade</h3>
        <p>Gerenciar especialidades médicas.</p>
      </div>
    </a>

    <a href="/paciente/listar" class="card-opcao">
      <div class="icone">👥</div>
      <div class="texto">
        <h3>Listar Pacientes</h3>
        <p>Visualizar todos os pacientes cadastrados.</p>
      </div>
    </a>

  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
