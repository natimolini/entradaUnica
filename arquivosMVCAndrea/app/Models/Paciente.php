<?php

class Paciente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir(array $dados) {
        $stmt = $this->pdo->prepare("INSERT INTO paciente (nome, nascimento, telefone) VALUES (:nome, :nascimento, :telefone)");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':nascimento', $dados['nascimento'], PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function buscarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM paciente ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM paciente WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(int $id, array $dados) {
        $stmt = $this->pdo->prepare("UPDATE paciente SET nome = :nome, nascimento = :nascimento, telefone = :telefone WHERE id = :id");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':nascimento', $dados['nascimento'], PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
