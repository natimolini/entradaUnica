<?php
require_once 'app/Models/Paciente.php';

class PacienteController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Paciente($pdo);
    }

    private function verificarSessao() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: /usuario/login');
            exit;
        }
    }

    public function listar() {
        $this->verificarSessao();
        $pacientes = $this->model->buscarTodos();
        include 'app/Views/paciente/listar.php';
    }

    public function cadastrar() {
        $this->verificarSessao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars(trim($_POST['nome']));
            $telefone = htmlspecialchars(trim($_POST['telefone']));
            $email = htmlspecialchars(trim($_POST['email']));
            $nascimento = htmlspecialchars(trim($_POST['nascimento']));

            if (empty($nome) || empty($telefone) || empty($email)) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            $dados = [
                'nome' => $nome,
                'telefone' => $telefone,
                'email' => $email,
                'nascimento' => $nascimento
            ];

            $this->model->inserir($dados);
            header('Location: /paciente/listar');
            exit;
        }

        include 'app/Views/paciente/cadastrar.php';
    }

    public function editar($id) {
        $this->verificarSessao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars(trim($_POST['nome']));
            $telefone = htmlspecialchars(trim($_POST['telefone']));
            $email = htmlspecialchars(trim($_POST['email']));
            $nascimento = htmlspecialchars(trim($_POST['nascimento']));

            if (empty($nome) || empty($telefone) || empty($email)) {
                echo "Todos os campos são obrigatórios.";
                return;
            }

            $dados = [
                'nome' => $nome,
                'telefone' => $telefone,
                'email' => $email,
                'nascimento' => $nascimento
            ];

            $this->model->atualizar($id, $dados);
            header('Location: /paciente/listar');
            exit;
        }

        $paciente = $this->model->buscarPorId($id);
        include 'app/Views/paciente/editar.php';
    }
}
