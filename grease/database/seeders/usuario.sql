-- USUARIOS
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
    '31276826893', MD5('Pa$$w0rd!'), 
    10000, 'm', 
    '(11) 98597-6152', NULL
  );