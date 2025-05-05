<?php

class Medico {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inserir(array $dados) {
        $stmt = $this->pdo->prepare("INSERT INTO medico (nome, crm, especialidade_id) VALUES (:nome, :crm, :especialidade_id)");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':crm', $dados['crm'], PDO::PARAM_STR);
        $stmt->bindParam(':especialidade_id', $dados['especialidade_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarTodos() {
        $sql = "SELECT m.*, e.nome AS especialidade 
                FROM medico m
                JOIN especialidade e ON m.especialidade_id = e.id
                ORDER BY m.nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM medico WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(int $id, array $dados) {
        $stmt = $this->pdo->prepare("UPDATE medico SET nome = :nome, crm = :crm, especialidade_id = :especialidade_id WHERE id = :id");
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':crm', $dados['crm'], PDO::PARAM_STR);
        $stmt->bindParam(':especialidade_id', $dados['especialidade_id'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
