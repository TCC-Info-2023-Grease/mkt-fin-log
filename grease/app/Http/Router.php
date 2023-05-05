<?php  

namespace App\Http;

use \Closure;
use \Exception;


/**
 * 
 */
class Router
{

	/**
	 * URL completa do projeto(raiz)
	 * @var string
	 */
	private $url = '';

	/**
	 * Prefixo que ficara em todas as rotas
	 * @var string
	 */
	private $prefix = '';

	/**
	 * Indice das rotas
	 * @var array
	 */
	private $routes = [];


	/**
	 * Instancia de Resquest
	 * @var Resquest
	 */
	private $request;

	/**
	 * Responsavel por iniciar a classe
	 * @param [type] $_url [description]
	 */
	public function __construct($_url) {
		$this->request = new Request();
		$this->url     = $_url;
		$this->setPrefix();
	}

	/**
	 * [setPrefix description]
	 */
	private function setPrefix() {
		// Informações da URL atual
		$parseURL = parse_url($this->url);	
		
		// DEFINE O PREFIXO DA URL
		$this->prefix = $parseURL['path'] ?? '';
	}


	/**
	 * [addRouter description]
	 * @param string $method [description]
	 * @param string $route  [description]
	 * @param array  $params [description]
	 */
	private function addRoute($method, $route, $params = []) {
		// print_r($method);
		// print_r($route);
		// print_r($params);
		

		// VALIDAÇÃO DOS PARAMETROS
		foreach ($params as $key => $value) {
			if ($value instanceOf Closure) {
				$params['controller'] = $value;
				unset($params[$key]);
				continue;
			}
		}

		$params["variables"] = [];

    $patternVariable = "/{(.*?)}/";
    if (preg_match_all($patternVariable, $route, $matches)) {
        $route = preg_replace($patternVariable, "(.*?)", $route);
        $params["variables"] = $matches[1];
    }

    $patternRoute = "/^" . str_replace("/", "\/", $route) . "$/";

    $this->routes[$patternRoute][$method] = $params;
	}


	/**
     * Define uma rota de GET
     *
     * @param string $route
     * @param array $params
     */
    public function get(string $route, array $params = [])
    {
        return $this->addRoute("GET", $route, $params);
    }

    /**
     * Define uma rota de POST
     *
     * @param string $route
     * @param array $params
     */
    public function post(string $route, array $params = [])
    {
        return $this->addRoute("POST", $route, $params);
    }

    /**
     * Define uma rota de PUT
     *
     * @param string $route
     * @param array $params
     */
    public function put(string $route, array $params = [])
    {
        return $this->addRoute("PUT", $route, $params);
    }

    /**
     * Define uma rota de DELETE
     *
     * @param string $route
     * @param array $params
     */
    public function delete(string $route, array $params = [])
    {
        return $this->addRoute("DELETE", $route, $params);
    }


	/**
	 * Retorna a URI, dseconsiderando o prefix
	 * @return [type] [description]
	 */
	private function getURI() {
		// URI DA REQUEST
		$uri = $this->request->getURI();

		// FATIA A URI COM O PREFIXO
		$explodeURI = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

		return end($explodeURI);
	}


	/**
	 * Obtem rota atual
	 * @return var
	 */
	private function getRoute() {
		// URI 
		$uri = $this->getURI();

		// METHOD
		$httpMethod = $this->request->getHttpMethod();

		// VALIDA AS ROTAS
		foreach ($this->routes as $patternRoute => $methods) {
      if (preg_match($patternRoute, $uri, $matches)) {
        if (isset($methods[$httpMethod])) {
            unset($matches[0]);

            $keys = $methods[$httpMethod]["variables"];
            $methods[$httpMethod]["variables"] = array_combine($keys, $matches);
            $methods[$httpMethod]["variables"]["request"] = $this->request;

            return $methods[$httpMethod];
        }

        throw new Exception("Método não permitido", 405);
      }
    }
	}


	/**
	 * Método para executar a rota atual
	 * @return Response;
	 */
	public function run() {
		try {
			$route = $this->getRoute();
			print_r($route);
		
			// VERIFICAR SE O CONTROLADOR EXISTE
			if (!isset($route['controller'])) {
				throw new Exception("A página não pode ser processada", 500);
			}

			// Argumentos da função
			$args = [];

			// Retorna a execução da função
			return call_user_func_array(
				$route['controller'], $args
			);

		} catch (Exception $e) {
			return new Response($e->getCode(), $e->getMessage());
		}
	}
}

?>