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
$routes['auth.sair'] = [
  'method' => 'GET',
  'file' => 'auth/sair',
  'params' => []
];


// --- Routes: Visitante
#-- 
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
  'file' => 'admin/home',
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
