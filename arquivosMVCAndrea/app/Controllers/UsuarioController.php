
<?php
class UsuarioController {
    private $model;

    public function __construct($pdo) {
        require_once 'app/Models/Usuario.php';
        $this->model = new Usuario($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $dadosUsuario = $this->model->buscarPorUsuario($usuario);
            if ($dadosUsuario && password_verify($senha, $dadosUsuario['senha'])) {
                $_SESSION['usuario'] = [
                    'id' => $dadosUsuario['id'],
                    'usuario' => $dadosUsuario['usuario']
                ];
                header('Location: /dashboard');
                exit;
            } else {
                $erro = "Usuário ou senha inválidos.";
                include 'app/Views/usuario/login.php';
                return;
            }
        }

        include 'app/Views/usuario/login.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = htmlspecialchars(trim($_POST['usuario']));
            $senha = htmlspecialchars(trim($_POST['senha']));
    
            if (empty($usuario) || empty($senha)) {
                echo "Usuário e senha são obrigatórios.";
                return;
            }
    
            $dados = [
                'usuario' => $usuario,
                'senha' => password_hash($senha, PASSWORD_DEFAULT)
            ];
    
            $this->model->inserir($dados);
            header('Location: /usuario/login');
            exit;
        }

        die("✔ Entrou no método cadastrar corretamente");
    
        // GET: exibe o formulário
        include __DIR__ . '/../Views/usuario/cadastrar.php';
    }
    
    
    
    
    
}
