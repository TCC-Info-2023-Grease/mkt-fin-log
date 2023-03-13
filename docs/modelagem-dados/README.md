# Modelagem de Dados
## Modelagem contento os modelos: Conceitual, Lógico e Fisico para o sistema.

Para o sistema que necessitamos montar, foi pensado em seguir uma modelagem
relacional, usando o SGBD: **MySQL** e por assim fazer uso da tecnologia **SQL**.

Assim, mapeamos as entidades que serão usadas dentro desse úniverso
(sendo ele: Marketing, Finanças e Logística do TCC).

### Entidades
+ Tipos Usuario
    - `tipo_usuario_id`: identificador único do tipo de usuário.
    - `titulo`: nome do tipo de usuário, como "administrador", "funcionário" ou "cliente".

+ Usuarios
	- `usuario_id`: identificador único do usuário.
	- `nome`: nome completo do usuário.
	- `idade`: idade do usuário.
	- `gênero`: gênero do usuário.
	- `email`: endereço de e-mail do usuário.
	- `senha`: senha do usuário.
	- `cpf`: número do CPF do usuário.
	- `telefone: número de telefone do usuário.`
	- `endereço`: endereço do usuário.
	- `foto_perfil`: URL da foto de perfil do usuário.
	- `tipo_usuario_id`: identificador único do tipo de usuário do usuário.
	- `data_cadastro`: data de cadastro do usuário.
	- `status`: data de cadastro do usuário.

+ Caixa
	- `caixa_id`: identificador único da entrada de caixa.
	- `data_descrição`: data da descrição da entrada de caixa.
	- `tipo_movimentação`: tipo de movimentação da entrada de caixa, como "entrada" ou "saída".
	- `forma_pagamento`: forma de pagamento da entrada de caixa, como "dinheiro" ou "cartão".
    - `número_documento`: número do documento da entrada de caixa.
valor: valor da entrada de caixa.
	- `valor`: valor da entrada de caixa.
	- `categoria`: categoria da entrada de caixa, como "vendas" ou "compras".
	- `conta`: conta da entrada de caixa.
	- `saldo_anterior`: saldo anterior da conta.
	- `saldo_atual`: saldo atual da conta.
	- `status`: status da entrada de caixa, como "pago" ou "pendente".
	- `tipo_pessoa`: tipo de pessoa relacionada à entrada de caixa, como "cliente" ou "fornecedor".
	- `observação`: observação da entrada de caixa.

+ Cenarios
	- `cenario_id`: identificador único do cenário.
	- `nome`: nome do cenário.
	- `descrição`: descrição do cenário.
	- `localização`: localização do cenário.
	- `data_criação`: data de criação do cenário.
	- `época`: época do cenário.
	- `estilo`: estilo do cenário.
	- `iluminação`: iluminação do cenário.
	- `requisitos_técnicos`: requisitos técnicos do cenário.
	- `interação_elenco`: interação do cenário com o elenco.
	- `orçamento`: orçamento do cenário.
	- `status_cenario`: status do cenário, como "em construção" ou "construido".
	- `foto_cenário`: URL da foto do cenário.

+ CategoriasMaterial
	- `categoria_id`: identificador único da categoria de material.
	- `name`: nome da categoria de material, como "tecidos" ou "fios".

+ Materiais
	- `material_id`: identificador único do material.
	- `fornecedor_id`: identificador único do fornecedor do material.
	- `cenario_id`: identificador único do cenário do material.
	- `nome`: nome do material.
	- `categoria_id`: identificador único da categoria de material do material.
	- `descrição`: Descrição detalhada do material
	- `unidade_medida`: Unidade de medida do material (metros, litros, etc.)
	- `estoque_minimo`: Quantidade mínima de estoque permitida do material
	- `etoque_atual`: Quantidade atual em estoque do material
	- `valor_unitario`: Valor unitário do material
	- `fornecedor`: Nome do fornecedor do material
	- `tipo_material`: Tipo de material (decoração, iluminação, etc.)
	- `status_material`: Status atual do material (em uso, disponível, etc.)
	- `data_cadastro`: Data de cadastro do material
	- `data_validade`: Data de validade do material (se aplicável)
	- `fabricante`: Nome do fabricante do material
	- `status`: Status geral do material (ativo, inativo, etc.)
	- `foto_material`: Foto do material

+ Fornecedores
	- `fornecedor_id`: Identificador único do fornecedor
	- `nome`: Nome do fornecedor
	- `email`: Endereço de e-mail do fornecedor
	- `endereço`: Endereço completo do fornecedor
	- `telefone`: Número de telefone do fornecedor
	- `descrição`: Descrição detalhada do fornecedor
	- `status`: Status atual do fornecedor (ativo, inativo, etc.)

+ Rank
	- `rank_id`: Identificador único do rank
	- `usuario_id`: Identificador único do usuário relacionado ao rank
	- `jogo_id`: Identificador único do jogo relacionado ao rank
	- `data`: Data de criação do rank
	- `pontuação`: Pontuação obtida no jogo

+ Jogo
	- `jogo_id`: Identificador único do jogo
	- `nome`: Nome do jogo
	- `descrição`: Descrição detalhada do jogo

+ Figurinos
	- `figurino_id`: Identificador único do figurino
	- `personagem_id`: Identificador do personagem ao qual o figurino pertence.
	- `nome`: Nome do figurino.
	- `descrição`: Descrição do figurino.
	- `tamanho`: Tamanho do figurino.
	- `tipo_figurino`: Tipo do figurino, como roupa de cena, acessórios, maquiagem, entre outros.
	- `data_cadastro`: Data de cadastro do figurino no sistema.
	- `status_figurino`: Status do figurino, como disponível, emprestado, em manutenção, entre outros.

+ Personagens
	- `personagem_id`: identificador único do personagem
	- `nome`: nome do personagem
	- `ator`: nome do ator que interpreta o personagem
	- `sexo`: gênero do personagem
	- `idade`: idade do personagem
	- `descrição`: descrição física do personagem
	- `história`: história do personagem
	- `habilidades`: habilidades do personagem

+ PedidosMateriais
	- `pedido_id`: identificador único do pedido de material
	- `material_id`: identificador único do material solicitado
	- `dada_pedido`: data em que o pedido foi feito
	- `data_entrega`: data em que o material foi entregue
	- `qtde_material`: quantidade de material solicitado
	- `status`: status do pedido (ex: aguardando entrega, entregue)
	- `usuario_id`: identificador único do usuário que fez o pedido
	- `descrição`: descrição do pedido

+ SaidaMaterial
	- `saida_id`: identificador único da saída de material
	- `usuario_id`: identificador único do usuário que solicitou a saída de material
	- `qtde`: quantidade de material que foi retirada

+ EntradaMaterial
	- `entrada_id`: identificador único da entrada de material
	- `usuario_id`: identificador único do usuário que solicitou a entrada de material
	- `qtde`: quantidade de material que foi retirada


## Modelos

### Modelo Conceitual
Para ter acesso a esse modelo vá em: [Modelo Conceitual - drawio](https://drive.google.com/file/d/1Gvh0baqJ7nmVJbEX7feulbdlqz8-Ixwc/view?usp=sharing)


### Modelo Lógico
Arquivo contento o modelo lógico: [Modelo Lógico](https://trello.com/1/cards/63fa42209738c9474243d146/attachments/640e52752c15ebefd44a87fd/download/Modelo_Fisico.sql)


### Modelo Fisico
Acessar o modelo fisico, vá em: [Modelo Fisico](https://trello.com/1/cards/63fa42209738c9474243d146/attachments/640e52752c15ebefd44a87fd/download/Modelo_Fisico.sql)

