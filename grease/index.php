<?php
require __DIR__ . '/config.php';
global $_ENV;

$pagina = "";

if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 'welcome';
}

$url = $_ENV['URL_VIEWS'];
switch ($pagina) {
    case 'welcome':
        $url .= "/welcome";
        break;
    
    case 'cadastrar':
        $url .= "/cadastrar";
        break;

    case 'login':
        $url .= "/login";
        break;
        
    case 'visitante-home':
        $url .= "/visitante/home";
        break;
    
    default:
        throw new Exception("houve um erro...", 2);
}

header("Location: " . $url . ".php");
exit();