CREATE DATABASE db_tcc;
USE db_tcc;

CREATE TABLE CategoriasMaterial (
	-- PK
	categoria_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    
	-- Atibutos
    nome VARCHAR(30) UNIQUE NOT NULL
);


CREATE TABLE meta (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  descricao TEXT,
  data_inicio DATE,
  data_fim DATE,
  total_necessario DECIMAL(10, 2),
  status INT(1) NOT NULL DEFAULT 0
);



CREATE TABLE MakeOf (
    -- PK & FK
    makeof_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT,
    uri TEXT,
    titulo VARCHAR(100),
    descricao TEXT
);


CREATE TABLE Usuarios (
	-- PK & FK
    usuario_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tipo_usuario CHAR(3),

    -- Atibutos
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    cpf VARCHAR(13) UNIQUE, 
    senha VARCHAR(200) NOT NULL,
    idade INT(3) NOT NULL,
    -- 'M', 'F', 'O', 'N'
    genero CHAR(1),
    celular VARCHAR(25),
    foto_perfil VARCHAR(200) 
        DEFAULT 'profile_default.png'
);

CREATE TABLE Alunos (
	-- PK & FK
    aluno_id INT PRIMARY KEY NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    status BOOLEAN DEFAULT TRUE
);

CREATE TABLE Caixa (
		-- PK & FK
    caixa_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usuario_id INT NULL,
    FOREIGN KEY (usuario_id)
        REFERENCES Usuarios (usuario_id),
    aluno_id INT NOT NULL,
    FOREIGN KEY (aluno_id)
        REFERENCES Alunos (aluno_id),
        
		-- Atibutos
    categoria VARCHAR(20),
    descricao VARCHAR(100),
    data_movimentacao DATETIME,
    valor DECIMAL(10, 2),
    tipo_movimentacao VARCHAR(20),
    forma_pagamento VARCHAR(20),
    status_caixa VARCHAR(15),
    obs TEXT
);


CREATE TABLE Personagens (
	-- PK & FK
	personagem_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    
	-- Atibutos
	nome VARCHAR(100) NOT NULL,
	ator VARCHAR(100) NOT NULL,
    -- 'M', 'F'
	sexo CHAR(1) NOT NULL,
	idade INT(3) NOT NULL, 
	descricao TEXT NOT NULL,
	historia TEXT NOT NULL,
	habilidades TEXT NOT NULL
);


CREATE TABLE Cenarios (
	-- PK & FK
	cenario_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    personagem_id INT NOT NULL,
    FOREIGN KEY (personagem_id)
        REFERENCES Personagens (personagem_id),
  
	-- Atibutos
	nome VARCHAR(100) NOT NULL,
	descricao VARCHAR(200) NOT NULL,
	localizacao VARCHAR(100) NOT NULL,
	data_criacao DATE NOT NULL,
	epoca VARCHAR(50) NOT NULL,
	estilo VARCHAR(50) NOT NULL,
	iluminacao VARCHAR(50) NOT NULL,
	requisitos_tecnicos VARCHAR(200),
	interacao_elenco VARCHAR(200),
	orcamento DECIMAL(10, 2) NOT NULL,
  -- 'para fazer', 'construindo', 'feito', 'cancelado'
	status_cenario VARCHAR(15),
	foto_cenario VARCHAR(100)
);

CREATE TABLE Fornecedores (
	-- PK & FK
    fornecedor_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    
    -- Atibutos
    ender TEXT NOT NULL,
    nome CHAR(100) NOT NULL,
    email VARCHAR(15) NOT NULL,
    telefone VARCHAR(15),
    celular VARCHAR(16),
    descricao VARCHAR(100) NOT NULL,
    status_fornecedor VARCHAR(45) NOT NULL
);


CREATE TABLE Materiais (
	-- PK & FK
	material_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id)
        REFERENCES CategoriasMaterial (categoria_id),
    usuario_id INT NOT NULL,
     FOREIGN KEY (usuario_id)
        REFERENCES Usuarios (usuario_id),


	-- Atibutos
	nome VARCHAR (100) NOT NULL,
	descricao VARCHAR (100) NOT NULL,
	qtde_estimada INT(4) NOT NULL,
	valor_estimado DECIMAL(5, 2) NOT NULL,
	valor_gasto DECIMAL(5, 2) NOT NULL,
	unidade_medida DECIMAL(2, 2) NOT NULL,
	estoque_minimo INT(4) NOT NULL,
	estoque_atual INT(4) NOT NULL,
	valor_unitario DECIMAL(10, 2),
	datahora_cadastro DATETIME NOT NULL,
	data_validade DATE NOT NULL,
	foto_material VARCHAR(50) NOT NULL,
	status_material VARCHAR(15) NOT NULL
);


CREATE TABLE SaidasMaterial (
	-- PK & FK
    saida_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    material_id INT,
    caixa_id INT,
    usuario_id INT,
    FOREIGN KEY (material_id)
        REFERENCES Materiais (material_id),
    FOREIGN KEY (caixa_id)
        REFERENCES Caixa (caixa_id),
    FOREIGN KEY (usuario_id)
        REFERENCES Usuarios (usuario_id),
    
    -- Atibutos
    qtde_compra INT(4) NOT NULL,
    valor_gasto DECIMAL(4, 2) NOT NULL,
    obs TEXT NOT NULL
);


CREATE TABLE EntradasMaterial (
	-- PK & FK
    entrada_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    material_id INT,
    caixa_id INT,
    usuario_id INT,
    FOREIGN KEY (material_id)
        REFERENCES Materiais (material_id),
    FOREIGN KEY (caixa_id)
        REFERENCES Caixa (caixa_id),
    FOREIGN KEY (usuario_id)
        REFERENCES Usuarios (usuario_id),
    
    -- Atibutos
    qtde_compra INT(4) NOT NULL,
    valor_gasto DECIMAL(4, 2) NOT NULL,
    obs TEXT NOT NULL
);

CREATE TABLE ResetPasswordRequests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expiration DATETIME NOT NULL,
    used BOOLEAN NOT NULL DEFAULT 0
);


CREATE TABLE Figurinos (
	-- PK & FK
	figurino_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	personagem_id INT NOT NULL,
    FOREIGN KEY (personagem_id)
        REFERENCES Personagens (personagem_id),
    
	-- Atibutos
	nome VARCHAR(100) NOT NULL,
	descricao TEXT NOT NULL,
	tamanho VARCHAR(3) NOT NULL,
	tipo_figurino VARCHAR(30) NOT NULL,
	data_cadastro DATE NOT NULL,
	status_figurino VARCHAR(15) NOT NULL
);
