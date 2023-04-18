<?php
require __DIR__ . '/config.php';
global $_VARIAVEIS;

$pagina = "";

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 'home';
}

$url = $_VARIAVEIS['URL_VIEWS'];
switch ($pagina) {
    case 'home':
        $url .= "/home";
        break;
    
    case 'cadastrar':
        $url .= "/cadastrar";
        break;
        
    case 'home':
        $url .= "/home";
        break;
    
    default:
        throw new Exception("houve um erro...", 2);
        break;
}

header("Location: " . $url . ".php");
exit();