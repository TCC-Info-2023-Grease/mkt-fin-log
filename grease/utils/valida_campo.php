<?php
/**
 * Função responsavel por validar um determinado campo
 *
 * @param  string  $campo Campo a ser validado
 * @return bool
 */
function valida_campo($campo) {
    return isset($campo) && !empty($campo) ? true : false;
}

?>