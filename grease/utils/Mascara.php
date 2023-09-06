<?php

class Mascara {
	
  public static function mascararCPF($cpf) {
    // Remove qualquer caractere não numérico do CPF
    $cpf = preg_replace('/\D/', '', $cpf);

    // Aplica a máscara ao CPF (formato: XXX.XXX.XXX-XX)
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
  }

  public static function mascararTelefone($telefone) {
        $telefone = preg_replace('/\D/', '', $telefone);
        if (strlen($telefone) == 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        } elseif (strlen($telefone) == 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } else {
            return $telefone;
        }
    }

    public static function mascararCEP($cep) {
        $cep = preg_replace('/\D/', '', $cep);
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

}
