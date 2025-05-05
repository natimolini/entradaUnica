<?php
class Consulta {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM consulta WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizar($id, $dados) {
        $stmt = $this->pdo->prepare("UPDATE consulta SET data = :data, hora = :hora WHERE id = :id");
        $stmt->bindParam(':data', $dados['data']);
        $stmt->bindParam(':hora', $dados['hora']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function buscarTodos() {
        $stmt = $this->pdo->query("SELECT c.*, p.nome AS paciente_nome, m.nome AS medico_nome
                                   FROM consulta c
                                   JOIN paciente p ON c.paciente_id = p.id
                                   JOIN medico m ON c.medico_id = m.id
                                   ORDER BY c.data, c.hora");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function agendar($dados) {
        $sql = "INSERT INTO consultas (paciente_id, medico_id, data, hora) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dados['paciente_id'], $dados['medico_id'], $dados['data'], $dados['hora']]);
    }

    public function inserir($dados) {
        $stmt = $this->pdo->prepare("INSERT INTO consulta (paciente_id, medico_id, data, hora) VALUES (:paciente_id, :medico_id, :data, :hora)");
        $stmt->bindParam(':paciente_id', $dados['paciente_id']);
        $stmt->bindParam(':medico_id', $dados['medico_id']);
        $stmt->bindParam(':data', $dados['data']);
        $stmt->bindParam(':hora', $dados['hora']);
        return $stmt->execute();
    }
    
}
