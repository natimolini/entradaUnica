<?php
session_start();

require_once 'config/config.php';

// Definição de rotas públicas (acesso sem login)
$rotasPublicas = [
    'usuario/login',
    'usuario/cadastrar'
];

// Pega a URL requisitada
$url = $_GET['url'] ?? 'usuario/login';
$url = rtrim($url, '/');
$partes = explode('/', $url);

$entidade = $partes[0] ?? 'usuario';
$acao     = $partes[1] ?? 'login';
$id       = $partes[2] ?? null;

// Redireciona para dashboard se já estiver logado e tentar acessar login
if ($entidade === 'usuario' && $acao === 'login' && isset($_SESSION['usuario'])) {
    header('Location: /dashboard');
    exit;
}

// Protege as rotas privadas
$urlAtual = "$entidade/$acao";
if (!in_array($urlAtual, $rotasPublicas)) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: /usuario/login');
        exit;
    }
}

// Autoload dos arquivos
spl_autoload_register(function ($classe) {
    foreach (['app/Controllers/', 'app/Models/'] as $pasta) {
        $arquivo = $pasta . $classe . '.php';
        if (file_exists($arquivo)) {
            require_once $arquivo;
            return;
        }
    }
});

$controllerName = ucfirst($entidade) . 'Controller';
$controllerPath = "app/Controllers/$controllerName.php";

if (file_exists($controllerPath)) {
    $controller = new $controllerName($pdo);
    if (method_exists($controller, $acao)) {
        $id ? $controller->$acao($id) : $controller->$acao();
    } else {
        echo "Erro: método '$acao' não encontrado.";
    }
} else {
    echo "Erro: controller '$controllerName' não encontrado.";
}
