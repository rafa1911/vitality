DROP DATABASE IF EXISTS vitality;
CREATE DATABASE vitality;

USE vitality;

CREATE TABLE aluno (
  id_aluno int(11) NOT NULL AUTO_INCREMENT,
  nome_aluno varchar(50) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  senha varchar(255) DEFAULT NULL,
  fk_personal_id_personal int(11) DEFAULT NULL,
  foto_perfil_aluno varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_aluno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO aluno (id_aluno, nome_aluno, email, senha, fk_personal_id_personal, foto_perfil_aluno) VALUES
(21, 'teste', 'teste@gmail.com', '$2y$10$Oj.J4azQ.LO7OZLTkiwjWuX0oGfgJ71Nt3A6rxxnpVMtDR346H4gO', 6, NULL),
(27, 'Ana Santos', 'anasantos@gmail.com', '$2y$10$84mGrLvnAuhZm7jDRykjU.WuNidEQcsQ9EdXY892VLRMjr0LAkvka', 6, NULL),
(30, 'Maria Julia', 'maju@gmail.com', '$2y$10$8KcU4L6vYxKziJixq4t5/Oj5t74VX.lxvphRZDp1NiAx9vayI1VnK', 6, NULL),
(34, 'Luisa Pedroso', 'pdroso@gmail.com', '$2y$10$7xbJPE6Lyg32lBiCoEgxyuRTKmT4goywOa1ywl8dhfdMXAvpxvVZK', 6, NULL),
(36, 'Rafaela Riganti', 'riganti@gmail.com', '$2y$10$7xbJPE6Lyg32lBiCoEgxyuRTKmT4goywOa1ywl8dhfdMXAvpxvVZK', 6, NULL);

CREATE TABLE documento (
  id_documento int(11) NOT NULL AUTO_INCREMENT,
  exame varchar(50) DEFAULT NULL,
  tipo varchar(50) DEFAULT NULL,
  avaliacao_fisica blob DEFAULT NULL,
  fk_aluno_id_aluno int(11) DEFAULT NULL,
  fk_personal_id_personal int(11) DEFAULT NULL,
  data_resposta datetime DEFAULT NULL,
  status enum('Solicitado','Respondido') DEFAULT 'Solicitado',
  PRIMARY KEY (id_documento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE exercicios (
  id_exercicio int(11) NOT NULL AUTO_INCREMENT,
  nome_exercicio varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_exercicio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE ficha_anamnese (
  id_ficha int(11) NOT NULL AUTO_INCREMENT,
  modelo varchar(100) DEFAULT NULL,
  respondido varchar(1) DEFAULT "n",
  fk_personal_id_personal int(11) DEFAULT NULL,
  fk_aluno_id_aluno int(11) DEFAULT NULL,
  data_criacao datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_ficha)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE modelos_ficha (
  id_modelo int(11) NOT NULL AUTO_INCREMENT,
  titulo varchar(255) NOT NULL,
  descricao text DEFAULT NULL,
  respondido text DEFAULT NULL,
  fk_personal_id_personal int(11) DEFAULT NULL,
  fk_aluno_id_aluno int(11) DEFAULT NULL,
  PRIMARY KEY (id_modelo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO modelos_ficha (id_modelo, titulo, descricao, fk_personal_id_personal, fk_aluno_id_aluno) VALUES
(1, 'teste', 'teste', 6, 3),
(2, 'teste2', 'teste2', 6, 3),
(3, 'teste3', '333', 6, 3),
(4, 'teste4', '?', 6, 3);

CREATE TABLE perguntas_modelo (
  id_pergunta int(11) NOT NULL AUTO_INCREMENT,
  pergunta text NOT NULL,
  tipo enum('text','radio','checkbox') NOT NULL,
  fk_modelo_id_modelo int(11) DEFAULT NULL,
  resposta text DEFAULT NULL,
  PRIMARY KEY (id_pergunta)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE opcoes_pergunta (
  id_opcao int(11) NOT NULL AUTO_INCREMENT,
  opcao text NOT NULL,
  fk_pergunta_id_pergunta int(11) NOT NULL,
  PRIMARY KEY (id_opcao),
  FOREIGN KEY (fk_pergunta_id_pergunta) REFERENCES perguntas_modelo(id_pergunta) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO perguntas_modelo (id_pergunta, pergunta, tipo, fk_modelo_id_modelo, resposta) VALUES
(1, '?', 'text', 3, NULL),
(2, '??', 'radio', 3, NULL),
(3, '?', 'checkbox', 4, NULL),
(4, '??', 'text', 4, NULL);

CREATE TABLE personal (
  id_personal int(11) NOT NULL AUTO_INCREMENT,
  nome_personal varchar(50) DEFAULT NULL,
  CREF varchar(10) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  senha varchar(255) DEFAULT NULL,
  foto_perfil_personal varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_personal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO personal (id_personal, nome_personal, CREF, email, senha, foto_perfil_personal) VALUES
(6, 'personal', 'cref4/sp', 'personal@gmail.com', '$2y$10$11LcwB29pFEcbpCmapN5WOZ/1UOqvi4HYwg1hwb3iZFXKtEEAlQzO', '../../uploads/personais/1.jpg'),
(19, 'higor', 'CREF5/RJ', 'higor@gmail.com', '$2y$10$zqcHHsKgA5jUDa33Rtns8.fT7oG1lih/0SPc/KN95LWxB7DSEQ.fy', '');

CREATE TABLE respostas (
  id_resposta int(11) NOT NULL AUTO_INCREMENT,
  fk_solicitacao_id int(11) DEFAULT NULL,
  fk_aluno_id_aluno int(11) NOT null,
  nome varchar(50) NOT NULL,
  data_nascimento date NOT NULL,
  sexo enum('Masculino', 'Feminino') NOT NULL,
  email varchar(50) NOT NULL,
  contato_emergencia varchar(20) NOT NULL,
  atividade enum('Sim', 'Não') NOT NULL,
  atividade_tipo varchar(255) DEFAULT NULL,
  peso decimal(5, 2) NOT NULL,
  estatura decimal(4, 1) NOT NULL,
  sintomas varchar(255) DEFAULT NULL,
  outro_desconforto varchar(255) DEFAULT NULL,
  fumante enum('Sim', 'Não') NOT NULL,
  fumante_tempo varchar(255) DEFAULT NULL,
  lesao enum('Sim', 'Não') NOT NULL,
  lesao_tempo varchar(255) DEFAULT NULL,
  problemas_saude varchar(255) DEFAULT NULL,
  alergias varchar(255) DEFAULT NULL,
  tratamento_medico varchar(255) DEFAULT NULL,
  medicamento varchar(255) DEFAULT NULL,
  frequencia_treino int(2) NOT NULL,
  objetivo varchar(255) DEFAULT NULL,
  arquivo varchar(255) DEFAULT NULL,
  data_resposta datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_resposta)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE solicitacoes (
  id_solicitacao int(11) NOT NULL AUTO_INCREMENT,
  fk_aluno_id_aluno int(11) NOT NULL,
  fk_personal_id_personal int(11) NOT NULL,
  tipo_documento varchar(255) DEFAULT NULL,
  status varchar(50) DEFAULT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  documento varchar(255) DEFAULT NULL,
  descricao varchar(255) DEFAULT NULL,
  PRIMARY KEY (id_solicitacao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO solicitacoes (id_solicitacao, fk_aluno_id_aluno, fk_personal_id_personal, tipo_documento, status, created_at, documento, descricao) VALUES
(8, 24, 23, 'Avaliação Física', 'Pendente', '2024-10-28 23:57:56', NULL, NULL),
(9, 24, 23, 'Exames', 'Pendente', '2024-10-28 23:58:00', NULL, NULL),
(10, 34, 23, 'Avaliação Física', 'Pendente', '2024-10-28 23:58:11', NULL, NULL),
(11, 34, 23, 'Exames', 'Pendente', '2024-10-29 00:03:54', NULL, NULL),
(12, 26, 23, 'Avaliação Física', 'Baixada', '2024-10-29 00:26:15', 'Captura de tela 2023-11-12 211332.png', ''),
(13, 26, 23, 'Exames', 'Baixada', '2024-10-29 00:26:36', 'Tree-Outline-Coloring-Page-53636793-1 (1).png', '');

CREATE TABLE treino (
  id_treino int(11) NOT NULL AUTO_INCREMENT,
  tipo varchar(50) DEFAULT NULL,
  numero_treino INT(11) NOT NULL,
  fk_aluno_id_aluno int(11) DEFAULT NULL,
  fk_personal_id_personal int(11) DEFAULT NULL,
  conclusao varchar(1) DEFAULT null,
  PRIMARY KEY (id_treino)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE treino_aparelho (
  treino_id INT(11) NOT NULL AUTO_INCREMENT,
  numero_treino INT(11) NOT NULL,
  aparelho VARCHAR(50) DEFAULT NULL,
  carga int NOT NULL,
  series INT(11) DEFAULT NULL,
  repeticao INT(11) DEFAULT NULL,
  descanso INT(11) DEFAULT NULL,
  PRIMARY KEY (treino_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
