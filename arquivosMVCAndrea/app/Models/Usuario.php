<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizar($id, $dados) {
        $sql = "UPDATE usuario SET usuario = :usuario";
        if (isset($dados['senha'])) {
            $sql .= ", senha = :senha";
        }
        $sql .= " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario', $dados['usuario']);
        if (isset($dados['senha'])) {
            $stmt->bindParam(':senha', $dados['senha']);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function buscarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM usuario ORDER BY usuario ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarPorUsuario($usuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function autenticar($usuario, $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE usuario = ? AND senha = ?");
        $stmt->execute([$usuario, $senha]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)");
        $stmt->bindParam(':usuario', $dados['usuario']);
        $stmt->bindParam(':senha', $dados['senha']);
        return $stmt->execute();
    }
    
}
