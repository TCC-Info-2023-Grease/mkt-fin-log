-- SEDERS TABELA USUARIOS

INSERT INTO 
  `usuarios` 
  (
    `usuario_id`, `tipo_usuario`, 
    `nome`, `email`, 
    `cpf`, `senha`, 
    `idade`, `genero`, 
    `celular`, `foto_perfil`
  ) 
VALUES
  (
    1, 'adm', 
    'Master Potato', 'master.potato@gmail.com', 
    '31276826893', '$2y$10$yk4mu8FVH7Ptj/9Q94MLb.h2pZz.pybRGCflNNWb0zbKlSs65y6Fq', 
    10000, 'm', 
    '0', NULL
  );


-- Categorias Material
INSERT INTO 
  `categoriasmaterial` 
  (
    `categoria_id`, `nome`
  ) 
VALUES
  (
    1, 'Cenário'
  ),
  (
    2, 'Figurino'
  );