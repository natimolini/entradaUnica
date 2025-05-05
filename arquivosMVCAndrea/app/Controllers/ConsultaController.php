<?php
require_once 'app/Models/Consulta.php';

class ConsultaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Consulta($pdo);
    }

    public function listar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        $consultas = $this->model->buscarTodos();
        include 'app/Views/consulta/listar.php';
    }

    public function detalhar($id) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            echo "ID inválido.";
            return;
        }

        $consulta = $this->model->buscarPorId($id);
        include 'app/Views/consulta/detalhe.php';
    }

    public function cadastrar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'paciente_id' => filter_input(INPUT_POST, 'paciente_id', FILTER_VALIDATE_INT),
                'medico_id'   => filter_input(INPUT_POST, 'medico_id', FILTER_VALIDATE_INT),
                'data'        => htmlspecialchars(trim($_POST['data'])),
                'hora'        => htmlspecialchars(trim($_POST['hora']))
            ];

            if (!$dados['paciente_id'] || !$dados['medico_id'] || empty($dados['data']) || empty($dados['hora'])) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            $this->model->inserir($dados);
            header('Location: /consulta/listar');
            exit;
        }

        include 'app/Views/consulta/cadastrar.php';
    }

    public function editar($id) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            echo "ID inválido.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'data' => htmlspecialchars(trim($_POST['data'])),
                'hora' => htmlspecialchars(trim($_POST['hora']))
            ];

            if (empty($dados['data']) || empty($dados['hora'])) {
                echo "Data e hora são obrigatórias.";
                return;
            }

            $this->model->atualizar($id, $dados);
            header('Location: /consulta/listar');
            exit;
        }

        $consulta = $this->model->buscarPorId($id);
        include 'app/Views/consulta/editar.php';
    }
}
