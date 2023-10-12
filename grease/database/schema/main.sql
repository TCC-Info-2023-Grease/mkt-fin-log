CREATE DATABASE db_tcc;
USE db_tcc;

CREATE TABLE categoriasmaterial (
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



CREATE TABLE makeof (
    -- PK & FK
    makeof_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT,
    uri TEXT,
    titulo VARCHAR(100),
    descricao TEXT
);


CREATE TABLE usuarios (
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

CREATE TABLE alunos (
	-- PK & FK
    aluno_id INT PRIMARY KEY NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    status BOOLEAN DEFAULT TRUE
);

CREATE TABLE caixa (
		-- PK & FK
    caixa_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usuario_id INT NULL,
    FOREIGN KEY (usuario_id)
        REFERENCES Usuarios (usuario_id),
    aluno_id INT NULL,
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


CREATE TABLE personagens (
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


CREATE TABLE cenarios (
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

CREATE TABLE fornecedores (
	-- PK & FK
    fornecedor_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    
    -- Atibutos
    ender TEXT NOT NULL,
    nome CHAR(100) NOT NULL,
    email VARCHAR(15)  NULL,
    cnpj VARCHAR(20) NULL,
    celular VARCHAR(16) NULL,
    descricao VARCHAR(100) NULL,
    status_fornecedor VARCHAR(45) NOT NULL
);

CREATE TABLE `contas` (
  `conta_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  `data_insercao` datetime,
  `status_conta` int(11) NOT NULL DEFAULT 0
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`conta_id`),
  ADD KEY `fornecedor_id` (`fornecedor_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `conta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contas`
--
ALTER TABLE `contas`
  ADD CONSTRAINT `contas_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `Fornecedores` (`fornecedor_id`),
  ADD CONSTRAINT `contas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);
COMMIT;

CREATE TABLE materiais (
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


CREATE TABLE saidasmaterial (
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


CREATE TABLE entradasmaterial (
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

CREATE TABLE resetpasswordrequests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expiration DATETIME NOT NULL,
    used BOOLEAN NOT NULL DEFAULT 0
);


CREATE TABLE figurinos (
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