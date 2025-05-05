-- Criação do banco de dados
DROP DATABASE IF EXISTS clinica_medica;
CREATE DATABASE clinica_medica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinica_medica;

-- Tabela de usuários do sistema
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabela de especialidades médicas
CREATE TABLE especialidade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Tabela de médicos
CREATE TABLE medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    crm VARCHAR(20) NOT NULL UNIQUE,
    especialidade_id INT,
    FOREIGN KEY (especialidade_id) REFERENCES especialidade(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de pacientes
CREATE TABLE paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nascimento DATE,
    telefone VARCHAR(20)
) ENGINE=InnoDB;

-- Tabela de consultas
CREATE TABLE consulta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT,
    medico_id INT,
    data DATE,
    hora TIME,
    FOREIGN KEY (paciente_id) REFERENCES paciente(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (medico_id) REFERENCES medico(id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;