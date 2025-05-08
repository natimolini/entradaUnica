// sistema.js otimizado e comentado para aprendizado

// Base para requisições assíncronas (define a pasta onde estão os arquivos PHP)
const apiBase = 'php';
/**
 * Carrega dinamicamente opções em um elemento <select>.
 * @param {string} endpoint Nome do arquivo PHP (sem .php)
 * @param {string} selectId ID do elemento select
 * @param {string} labelProp Propriedade para exibir no select (padrão: 'nome')
 */
async function carregarSelect(endpoint, selectId, labelProp = 'nome') {
  try {
    const resp = await fetch(`${apiBase}/${endpoint}.php`);
    const dados = await resp.json();
    const select = document.getElementById(selectId);

    select.innerHTML = '<option value="">Selecione...</option>';
    dados.forEach(item => {
      const opt = document.createElement('option');
      opt.value = item.id;
      opt.textContent = item[labelProp];
      select.appendChild(opt);
    });
  } catch (err) {
    console.error(`Erro ao carregar ${endpoint}:`, err);
  }
}

/**
 * Envia os dados de um formulário via POST e redireciona em caso de sucesso.
 */
async function enviarFormulario(endpoint, payload, redirecionarPara) {
  try {
    const resposta = await fetch(`${apiBase}/${endpoint}.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });

    if (resposta.ok) {
      alert('Cadastro realizado com sucesso!');
      window.location.href = redirecionarPara;
    } else {
      let erro = 'Erro desconhecido';
      try {
        const data = await resposta.json();
        erro = data.erro || erro;
      } catch {}
      alert('Erro: ' + erro);
    }
  } catch (e) {
    alert('Erro de conexão com o servidor.');
  }
}

/**
 * Busca os detalhes de uma consulta específica.
 */
async function carregarConsultaDetalhe(id) {
  const resp = await fetch(`${apiBase}/consultas.php`);
  const dados = await resp.json();
  return dados.find(c => c.id == id);
}

/**
 * Atualiza a data e hora de uma consulta existente.
 */
async function atualizarConsulta(id, dataHora) {
  const resp = await fetch(`${apiBase}/consultas.php?id=${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ dataHora })
  });
  return resp.ok;
}

/**
 * Exclui uma consulta existente.
 */
async function excluirConsulta(id) {
  const resp = await fetch(`${apiBase}/consultas.php?id=${id}`, { method: 'DELETE' });
  return resp.ok;
}

async function carregarMedicos() {
  const tabela = document.querySelector('#tabela-medicos tbody');
  
  if (!tabela) return;

  try {
    const resp = await fetch(`${apiBase}/medicos.php`);
    const medicos = await resp.json();

    console.log(medicos);
    
    tabela.innerHTML = '';
    medicos.forEach(medico => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${medico.nome}</td>
        <td>${medico.crm}</td>
        <td>${medico.especialidade}</td>
        <td><button class="btn-excluir" onclick="excluirMedicos(${medico.id})">Excluir</button></td>
      `;
      tabela.appendChild(tr);
    });
  } catch (err) {
    console.error('Erro ao carregar médicos:', err);
  }
}

async function excluirMedicos(id) {
  const confirmar = confirm("Tem certeza que deseja excluir este médico?");
  if (!confirmar) return;

  try {
    const resp = await fetch(`${apiBase}/medicos.php?id=${id}`, {
      method: 'DELETE'
    });

    if (!resp.ok) {
      throw new Error("Erro ao excluir médico.");
    }

    alert("Médico excluído com sucesso.");
    carregarMedicos(); // Atualiza a tabela após exclusão
  } catch (err) {
    alert("Erro ao excluir médico.");
    console.error(err);
  }
}


/**
 * Carrega todos os pacientes na tabela da página de listagem.
 */
async function carregarPacientes() {
  const tabela = document.querySelector('#tabela-pacientes tbody');
  if (!tabela) return;

  try {
    const resp = await fetch(`${apiBase}/pacientes.php`);
    const pacientes = await resp.json();

    tabela.innerHTML = '';
    pacientes.forEach(paciente => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${paciente.nome}</td>
        <td>${paciente.email}</td>
        <td>${paciente.telefone}</td>
        <td>${paciente.dataNascimento}</td>
        <td><button class="btn-excluir" onclick="excluirPaciente(${paciente.id})">Excluir</button></td>
      `;
      tabela.appendChild(tr);
    });
  } catch (err) {
    console.error('Erro ao carregar pacientes:', err);
  }
}

async function carregarEspecilidade() {
  const tabela = document.querySelector('#tabela-especialidades tbody');
  if (!tabela) return;

  try {
    const resp = await fetch(`${apiBase}/especialidades.php`);
    const especialidades = await resp.json();

    tabela.innerHTML = '';
    especialidades.forEach(especialidade => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${especialidade.nome}</td>
        <td><button class="btn-excluir" onclick="excluirEspecialidade(${especialidade.id})">Excluir</button></td>
      `;
      tabela.appendChild(tr);
    });
  } catch (err) {
    console.error('Erro ao carregar especialidades:', err);
  }
}

/**
 * Exclui um paciente selecionado.
 */
async function excluirPaciente(id) {
  if (!confirm('Deseja realmente excluir este paciente?')) return;

  const resp = await fetch(`${apiBase}/pacientes.php?id=${id}`, {
    method: 'DELETE'
  });

  if (resp.ok) {
    alert('Paciente excluído com sucesso.');
    carregarPacientes();
  } else {
    alert('Erro ao excluir paciente.');
  }
}

async function excluirEspecialidade(id) {
  if (!confirm('Deseja realmente excluir esta especialidade?')) return;

  const resp = await fetch(`${apiBase}/especialidades.php?id=${id}`, {
    method: 'DELETE'
  });

  if (resp.ok) {
    alert('Especialidade excluída com sucesso.');
    carregarEspecialidade(); // Atualiza a tabela
  } else {
    alert('Erro ao excluir especialidade.');
  }
}

// Detecta a página atual e ativa os scripts específicos para cada uma
window.addEventListener('DOMContentLoaded', () => {
  const pagina = window.location.pathname;

  if (pagina.includes('cadastro-consulta.html')) {
    carregarSelect('pacientes', 'paciente');
    carregarSelect('medicos', 'medico');
    carregarSelect('especialidades', 'especialidade');

    document.getElementById('form-consulta').addEventListener('submit', e => {
      e.preventDefault();
      const data = document.getElementById('data').value;
      const hora = document.getElementById('hora').value;
      const payload = {
        pacienteId: document.getElementById('paciente').value,
        medicoId: document.getElementById('medico').value,
        especialidadeId: document.getElementById('especialidade').value,
        dataHora: `${data}T${hora}:00`
      };
      enviarFormulario('consultas', payload, 'agenda.html');
    });
  }

  if (pagina.includes('cadastro-paciente.html')) {
    document.getElementById('form-paciente').addEventListener('submit', e => {
      e.preventDefault();
      const payload = {
        nome: document.getElementById('nome').value,
        email: document.getElementById('email').value,
        telefone: document.getElementById('telefone').value,
        dataNascimento: document.getElementById('dataNascimento').value
      };
      enviarFormulario('pacientes', payload, 'dashboard.html');
    });
  }

  if (pagina.includes('cadastro-medico.html')) {
    carregarSelect('especialidades', 'especialidade');
    document.getElementById('form-medico').addEventListener('submit', e => {
      e.preventDefault();
      const payload = {
        nome: document.getElementById('nome').value,
        crm: document.getElementById('crm').value,
        especialidadeId: document.getElementById('especialidade').value
      };
      enviarFormulario('medicos', payload, 'dashboard.html');
    });
  }

  if (pagina.includes('cadastro-especialidade.html')) {
    document.getElementById('form-especialidade').addEventListener('submit', e => {
      e.preventDefault();
      const payload = {
        nome: document.getElementById('nome').value
      };
      enviarFormulario('especialidades', payload, 'dashboard.html');
    });
  }

  if (pagina.includes('consulta-detalhe.html')) {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    carregarConsultaDetalhe(id).then(consulta => {
      document.getElementById('paciente').value = consulta.paciente;
      document.getElementById('medico').value = consulta.medico;
      document.getElementById('especialidade').value = consulta.especialidade;
      const [data, hora] = consulta.dataHora.split('T');
      document.getElementById('data').value = data;
      document.getElementById('hora').value = hora.slice(0, 5);
    });

    document.getElementById('form-detalhe').addEventListener('submit', e => {
      e.preventDefault();
      const novaDataHora = `${document.getElementById('data').value}T${document.getElementById('hora').value}:00`;
      atualizarConsulta(id, novaDataHora).then(ok => {
        if (ok) {
          alert('Consulta atualizada!');
          window.location.href = 'agenda.html';
        }
      });
    });

    document.getElementById('btn-excluir').addEventListener('click', () => {
      if (confirm('Deseja realmente excluir esta consulta?')) {
        excluirConsulta(id).then(ok => {
          if (ok) {
            alert('Consulta excluída');
            window.location.href = 'agenda.html';
          }
        });
      }
    });
  }

  if (pagina.includes('pacientes.html')) {
    carregarPacientes();
  }

  if (pagina.includes('listagem-medicos.html')) {
    carregarMedicos();
  }

  if (pagina.includes('listagem-especialidades.html')) {
    carregarEspecialidades();
  }
});


// Inicializa o FullCalendar na página agenda.html
// Permite visualizar as consultas em formato de calendário

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      locale: 'pt-br',
      buttonText: {
        today: 'Hoje',
        month: 'Mês',
        week: 'Semana',
        day: 'Dia'
      },
      events: async function(fetchInfo, successCallback, failureCallback) {
        try {
          const resp = await fetch('php/consultas.php');
          const dados = await resp.json();
          const eventos = dados.map(c => ({
            id: c.id,
            title: `${c.paciente} - ${c.medico}`,
            start: c.dataHora
          }));
          successCallback(eventos);
        } catch (error) {
          console.error('Erro ao carregar consultas:', error);
          successCallback([]);
        }
      },
      eventClick: function(info) {
        window.location.href = `consulta-detalhe.html?id=${info.event.id}`;
      }
    });

    calendar.render();
  });

 // ================================================== //
// Funções relacionadas ao logout //
// ================================================== //
document.addEventListener('DOMContentLoaded', function() {
    const btnLogout = document.getElementById('btn-logout');
    if (btnLogout) {
      btnLogout.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Deseja realmente sair?')) {
          window.location.href = 'login.html';
        }
      });
    }
  });
  
 // ================================================== //
  // Envio assíncrono do formulário de cadastro de paciente //
  // ================================================== //
  const formPaciente = document.getElementById('form-paciente');

  if (formPaciente) {
    formPaciente.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(formPaciente);

      fetch('php/pacientes.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          alert('Paciente cadastrado com sucesso!');
          formPaciente.reset();
        } else {
          alert('Erro ao cadastrar paciente.');
        }
      })
      .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao conectar ao servidor.');
      });
    });
    };
  