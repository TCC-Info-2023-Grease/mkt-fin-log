<?php
$routes = [];

// --- Routes: Home
$routes['welcome'] = [
  'method' => 'GET',
  'file' => 'welcome',
  'params' => []
];
$routes['about'] = [
  'method' => 'GET',
  'file' => 'about',
  'params' => []
];
$routes['contact'] = [
  'method' => 'GET',
  'file' => 'contact',
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
      'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/',
    ],
  ],
];