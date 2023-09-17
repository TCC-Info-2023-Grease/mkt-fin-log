<?php
$routes = [];

// --- Routes: Home
$routes['welcome'] = [
  'method' => 'GET',
  'file' => 'welcome',
  'params' => []
];
$routes['home.projeto'] = [
  'method' => 'GET',
  'file' => 'home/projeto',
  'params' => []
];
$routes['home.contato'] = [
  'method' => 'GET',
  'file' => 'home/contato',
  'params' => []
];


// --- Routes: Auth
$routes['auth.login'] = [
  'method' => 'GET',
  'file' => 'auth/login',
  'params' => []
];
$routes['auth.cadastrar'] = [
  'method' => 'GET',
  'file' => 'auth/cadastrar',
  'params' => []
];
$routes['auth.esqueci_senha'] = [
  'method' => 'GET',
  'file' => 'auth/esqueci_senha',
  'params' => []
];
$routes['auth.redefinir_senha'] = [
  'method' => 'GET',
  'file' => 'auth/redefinir_senha',
  'params' => []
];
$routes['auth.sair'] = [
  'method' => 'GET',
  'file' => 'auth/sair',
  'params' => []
];


// --- Routes: Visitante
#-- 
$routes['visitante.home'] = [
  'method' => 'GET',
  'file' => 'visitante/home',
  'params' => []
];
$routes['visitante.financas'] = [
  'method' => 'GET',
  'file' => 'visitante/financas',
  'params' => []
];
$routes['visitante.makeof'] = [
  'method' => 'GET',
  'file' => 'visitante/make-of/index',
  'params' => []
];


// --- Routes: Admin
#-- 
$routes['admin.home'] = [
  'method' => 'GET',
  'file' => 'admin/dashboard',
  'params' => []
];

#-- 
$routes['admin.material.index'] = [
  'method' => 'GET',
  'file' => 'admin/material/index',
  'params' => []
];
$routes['admin.material.create'] = [
  'method' => 'GET',
  'file' => 'admin/material/create',
  'params' => []
];


$routes['admin.material.entrada.create'] = [
  'method' => 'GET',
  'file' => 'admin/material/entrada.create',
  'params' => []
];
$routes['admin.material.entrada.index'] = [
  'method' => 'GET',
  'file' => 'admin/material/entrada.index',
  'params' => []
];

$routes['admin.material.saida.create'] = [
  'method' => 'GET',
  'file' => 'admin/material/saida.create',
  'params' => []
];
$routes['admin.material.saida.index'] = [
  'method' => 'GET',
  'file' => 'admin/material/saida.index',
  'params' => []
];


# --
$routes['admin.categoria_material.index'] = [
  'method' => 'GET',
  'file' => 'admin/categoria-material/index',
  'params' => []
];
$routes['admin.categoria_material.create'] = [
  'method' => 'GET',
  'file' => 'admin/categoria-material/create',
  'params' => []
];
$routes['admin.categoria_material.edit'] = [
  'method' => 'GET',
  'file' => 'admin/categoria-material/edit',
  'params' => []
];

# --
$routes['admin.sala.index'] = [
  'method' => 'GET',
  'file' => 'admin/sala/index',
  'params' => []
];
$routes['admin.sala.create'] = [
  'method' => 'GET',
  'file' => 'admin/sala/create',
  'params' => []
];
$routes['admin.sala.edit'] = [
  'method' => 'GET',
  'file' => 'admin/sala/edit',
  'params' => []
];
$routes['admin.sala.relatorio'] = [
  'method' => 'GET',
  'file' => 'admin/sala/relatorio',
  'params' => []
];

# --
$routes['admin.fornecedor.index'] = [
  'method' => 'GET',
  'file' => 'admin/fornecedor/index',
  'params' => []
];
$routes['admin.fornecedor.create'] = [
  'method' => 'GET',
  'file' => 'admin/fornecedor/create',
  'params' => []
];
$routes['admin.fornecedor.edit'] = [
  'method' => 'GET',
  'file' => 'admin/fornecedor/edit',
  'params' => []
];
$routes['admin.fornecedor.relatorio'] = [
  'method' => 'GET',
  'file' => 'admin/fornecedor/relatorio',
  'params' => []
];

# --
$routes['admin.conta.index'] = [
  'method' => 'GET',
  'file' => 'admin/conta/index',
  'params' => []
];
$routes['admin.conta.create'] = [
  'method' => 'GET',
  'file' => 'admin/conta/create',
  'params' => []
];
$routes['admin.conta.edit'] = [
  'method' => 'GET',
  'file' => 'admin/conta/edit',
  'params' => []
];
$routes['admin.conta.relatorio'] = [
  'method' => 'GET',
  'file' => 'admin/conta/relatorio',
  'params' => []
];

# --
$routes['admin.alunos.index'] = [
  'method' => 'GET',
  'file' => 'admin/alunos/index',
  'params' => []
];
$routes['admin.alunos.create'] = [
  'method' => 'GET',
  'file' => 'admin/alunos/create',
  'params' => []
];
$routes['admin.alunos.create.all'] = [
  'method' => 'GET',
  'file' => 'admin/alunos/create_all',
  'params' => []
];
$routes['admin.alunos.edit'] = [
  'method' => 'GET',
  'file' => 'admin/alunos/edit',
  'params' => []
];

# --
$routes['admin.meta.index'] = [
  'method' => 'GET',
  'file' => 'admin/meta/index',
  'params' => []
];
$routes['admin.meta.create'] = [
  'method' => 'GET',
  'file' => 'admin/meta/create',
  'params' => []
];
$routes['admin.meta.edit'] = [
  'method' => 'GET',
  'file' => 'admin/meta/edit',
  'params' => []
];


# --
$routes['admin.usuario.index'] = [
  'method' => 'GET',
  'file' => 'admin/usuarios/index',
  'params' => []
];
$routes['admin.usuario.create'] = [
  'method' => 'GET',
  'file' => 'admin/usuarios/create',
  'params' => []
];
$routes['admin.usuario.edit'] = [
  'method' => 'GET',
  'file' => 'admin/usuarios/edit',
  'params' => []
];


#--
$routes['admin.makeof.index'] = [
  'method' => 'GET',
  'file' => 'admin/make-of/index',
  'params' => []
];
$routes['admin.makeof.create'] = [
  'method' => 'GET',
  'file' => 'admin/make-of/create',
  'params' => []
];


#--
$routes['admin.caixa.index'] = [
  'method' => 'GET',
  'file' => 'admin/caixa/index',
  'params' => []
];
$routes['admin.caixa.show'] = [
  'method' => 'GET',
  'file' => 'admin/caixa/show',
  'params' => [
    'password' => [
      'required',
      'integer'
    ]
  ]
];
$routes['admin.caixa.entrada.create'] = [
  'method' => 'GET',
  'file' => 'admin/caixa/create.entrada',
  'params' => []
];
$routes['admin.caixa.saida.create'] = [
  'method' => 'GET',
  'file' => 'admin/caixa/create.saida',
  'params' => []
];
$routes['admin.caixa.relatorio'] = [
  'method' => 'GET',
  'file' => 'admin/caixa/relatorio',
  'params' => []
];


// --- Routes: Actions
$routes['cadastrar-usuario'] = [
  'method' => 'POST',
  'file' => 'cadastrar',
  'params' => [
    'name' => [
      'required',
      'string:min_length=3,max_length=50',
    ],
    'email' => [
      'required',
      'email',
    ],
    'password' => [
      'required',
      'min_length:8,max_length:20',
      //  padrão da senha: letras minuscula e maiscula, 8 - 20 caracteres
      'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/',
    ],
  ],
];
