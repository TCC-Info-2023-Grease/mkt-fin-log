<?php

/**
 * Função para renderizar um componente
 *
 * @param  string  $componente Nome do componente a ser renderizado
 * @return void
 */
function render_component( $componente ) {
  require_once(dirname(__DIR__) .'/resources/views/components/'. $componente .'.php');
}

?>