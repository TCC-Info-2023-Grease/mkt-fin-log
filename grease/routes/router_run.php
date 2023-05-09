<?php
import_utils([ 'validateParam' ]);

/**
 * Function router_run executa o roteamento das rotas
 *
 * @param array $routes Rotas da aplicação
 * @param array $env Variavel de Ambiente
 *
 * @return void
 */
function router_run(array $routes, array $env): void {
    $method = $_SERVER['REQUEST_METHOD'];
    $params = ($method == 'GET') ? $_GET : $_POST;

    // verifica se $params['pagina'] existe e define $pagina como uma string vazia caso contrário
    $pagina = $params['pagina'] ?? ''; 

    // verifica se $pagina existe como chave em $routes
    if (array_key_exists($pagina, $routes)) { 
        $route = $routes[$pagina];
        
        $url = $method == 'GET' ? $env['URL_VIEWS'] : $env['URL_CONTROLLERS'];
        $url .= '/' . $route['file'] . '.php';

        $paramsArray = [];
        // itera sobre cada parâmetro definido em $route
        foreach ($route['params'] as $param => $rules) { 
            $options = [];
            if (isset($rules['pattern'])) { 
                // verifica se há uma expressão regular definida em $rules
                $options['pattern'] = $rules['pattern'];
                $options['message'] = $rules['message'];
            }

            // define o valor do parâmetro a partir de $_GET ou $_POST
            $value = isset($params[$param]) ? $params[$param] : null; 

            // aplica validação e adiciona o parâmetro ao array $paramsArray
            $paramsArray[] = validateParam($param, $value, $options); 
        }

        if (!empty($paramsArray)) {
            $separator = ($method == 'GET') ? '?' : '';
            $url .= $separator . implode('&', $paramsArray);
        }

        // redireciona o usuário para a URL final
        header("Location: $url"); 
    } else {
        // redireciona o usuário para a página 404
        header("Location: " . $env['ROUTE'] . "welcome"); 
    }

    exit(); 
}