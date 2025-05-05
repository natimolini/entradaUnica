<?php

class Especialidade {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO especialidade (nome) VALUES (:nome)");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function buscarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM especialidade ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM especialidade WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $dados) {
        $stmt = $this->pdo->prepare("UPDATE especialidade SET nome = :nome WHERE id = :id");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
