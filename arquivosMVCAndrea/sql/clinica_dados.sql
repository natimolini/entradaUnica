USE clinica_medica;

-- Inserção de usuários
INSERT INTO usuario (usuario, senha) VALUES
('secretaria1', SHA2('123456', 256)),
('secretaria2', SHA2('abcdef', 256));

-- Inserção de especialidades
INSERT INTO especialidade (nome) VALUES
('Cardiologia'),
('Pediatria'),
('Dermatologia');

-- Inserção de médicos
INSERT INTO medico (nome, crm, especialidade_id) VALUES
('Dr. João Silva', 'CRM12345', 1),
('Dra. Ana Santos', 'CRM67890', 2),
('Dr. Carlos Lima', 'CRM54321', 3);

-- Inserção de pacientes
INSERT INTO paciente (nome, nascimento, telefone) VALUES
('Maria Oliveira', '1985-05-20', '41999998888'),
('Pedro Costa', '1990-09-15', '41988887777'),
('Fernanda Lima', '2000-01-30', '41977776666');

-- Inserção de consultas
INSERT INTO consulta (paciente_id, medico_id, data, hora) VALUES
(1, 1, '2024-06-15', '10:00:00'),
(2, 2, '2024-06-16', '11:30:00'),
(3, 3, '2024-06-17', '14:00:00');