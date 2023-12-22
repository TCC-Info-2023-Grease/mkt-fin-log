<?php
import_utils([ 'validateParam' ]);

function router_run(array $routes, array $env) {
    $method = $_SERVER['REQUEST_METHOD'];
    $params = ($method === 'GET') ? $_GET : $_POST;

    // Verifica se $params['pagina'] existe e define $pagina como uma string vazia caso contrário
    $pagina = $params['pagina'] ?? '';

    // Verifica se $pagina existe como chave em $routes
    if (array_key_exists($pagina, $routes)) {
        $route = $routes[$pagina];

        $url = $method === 'GET' ? $env['VIEWS'] : $env['URL_CONTROLLERS'];
        $url .= '/' . $route['file'] . '.php';

        $paramsArray = [];
        // Itera sobre cada parâmetro definido em $route
        foreach ($route['params'] as $param => $rules) {
            $options = [];
            if (isset($rules['pattern'])) {
                // Verifica se há uma expressão regular definida em $rules
                $options['pattern'] = $rules['pattern'];
                $options['message'] = $rules['message'];
            }

            // Define o valor do parâmetro a partir de $_GET ou $_POST
            $value = isset($params[$param]) ? $params[$param] : null;

            // Aplica validação e adiciona o parâmetro ao array $paramsArray
            $paramsArray[] = validateParam($param, $value, $options);
        }

        if (!empty($paramsArray)) {
            $separator = $method === 'GET' ? '?' : '';
            $url .= $separator . implode('&', $paramsArray);
        }

        // Redireciona o usuário para a URL final
        header("Location: $url");
    } else {
        // Redireciona o usuário para a página 404
        header("Location: " . $env['ROUTE'] . "welcome");
    }

    exit();
}

