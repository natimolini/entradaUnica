<?php
require_once 'app/Models/Especialidade.php';

class EspecialidadeController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Especialidade($pdo);
    }

    public function listar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        $especialidades = $this->model->buscarTodos();
        include 'app/Views/especialidade/listar.php';
    }

    public function cadastrar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars(trim($_POST['nome']));

            if (empty($nome)) {
                echo "O nome da especialidade é obrigatório.";
                return;
            }

            $dados = ['nome' => $nome];

            $this->model->inserir($dados);
            header('Location: /especialidade/listar');
            exit;
        }

        include 'app/Views/especialidade/cadastrar.php';
    }

    public function editar($id) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars(trim($_POST['nome']));

            if (empty($nome)) {
                echo "O nome da especialidade é obrigatório.";
                return;
            }

            $dados = ['nome' => $nome];

            $this->model->atualizar($id, $dados);
            header('Location: /especialidade/listar');
            exit;
        }

        $especialidade = $this->model->buscarPorId($id);
        include 'app/Views/especialidade/editar.php';
    }
}
