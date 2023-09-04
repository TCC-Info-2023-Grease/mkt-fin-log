<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'navegate' ]);


# ----- Consulta Material
$material = new Material($mysqli);
 
//print_r($material->buscarTodos());
return [
	$materiais           = $material->buscarTodos(),
	$categoriasMateriais = $material->obterCategorias(),
	$quantidadeMateriais = $material->contarMateriaisPorCategoria(),
	$dadosStatus         = $material->contarMateriaisPorStatus(),
	$gastosUltimoMes 		 = $material->contarGastosUltimoMes()
];
?>