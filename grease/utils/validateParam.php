<?php

function validateParam($param, $value, $options = []) {
  // Verifica se o parâmetro é obrigatório e não foi fornecido
  if ($options['required'] ?? false && $value === null) {
      throw new Exception("Parâmetro '$param' é obrigatório.", 400);
  }

  // Se o parâmetro não foi fornecido e não é obrigatório, não é necessário validar
  if ($value === null) {
      return '';
  }

  // Aplica as regras de validação definidas no array $routes
  $rules = $options['rules'] ?? [];
  foreach ($rules as $rule => $ruleOptions) {
      switch ($rule) {
          case 'min_length':
              if (strlen($value) < $ruleOptions['value']) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          case 'max_length':
              if (strlen($value) > $ruleOptions['value']) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          case 'regex':
              if (!preg_match($ruleOptions['pattern'], $value)) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          case 'email':
              if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          case 'string':
              if (!is_string($value)) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          case 'integer':
              if (!ctype_digit($value)) {
                  throw new Exception($ruleOptions['message'], 400);
              }
              break;
          default:
              throw new Exception("Regra de validação '$rule' desconhecida.", 500);
      }
  }

  // Se chegou até aqui, o valor é válido
  return "$param=$value";
}
