<?php
require_once 'app/Models/Medico.php';

class MedicoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Medico($pdo);
    }

    public function listar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        $medicos = $this->model->buscarTodos();
        include 'app/Views/medico/listar.php';
    }

    public function cadastrar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = htmlspecialchars(trim($_POST['nome']));
            $crm   = htmlspecialchars(trim($_POST['crm']));
            $espId = filter_input(INPUT_POST, 'especialidade_id', FILTER_VALIDATE_INT);

            if (empty($nome) || empty($crm) || !$espId) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            $dados = [
                'nome' => $nome,
                'crm' => $crm,
                'especialidade_id' => $espId
            ];

            $this->model->inserir($dados);
            header('Location: /medico/listar');
            exit;
        }

        include 'app/Views/medico/cadastrar.php';
    }

    public function editar($id) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = htmlspecialchars(trim($_POST['nome']));
            $crm   = htmlspecialchars(trim($_POST['crm']));
            $espId = filter_input(INPUT_POST, 'especialidade_id', FILTER_VALIDATE_INT);

            if (empty($nome) || empty($crm) || !$espId) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            $dados = [
                'nome' => $nome,
                'crm' => $crm,
                'especialidade_id' => $espId
            ];

            $this->model->atualizar($id, $dados);
            header('Location: /medico/listar');
            exit;
        }

        $medico = $this->model->buscarPorId($id);
        include 'app/Views/medico/editar.php';
    }
}
