<?php  

namespace App\Http;

/**
 * 
 */
class Request
{
	/**
	 * [$httpMethod description]
	 * @var [type]
	 */
	private $httpMethod;

	/**
	 * [$uri description]
	 * @var [type]
	 */
	private $uri;

	/**
	 * [$queryParams description]
	 * @var array
 	*/
	private $queryParams = [];

	/**
	 * [$postVars description]
	 * @var array
	 */
	private $postVars = [];

	/**
	 * [$headers description]
	 * @var array
	 */
	private $headers = [];

	/**
	 * [__construct description]
	 */
	public function __construct(){
		$this->queryParams =  $_GET  ?? [];
		$this->postVars    =  $_POST ?? [];
		$this->headers     = getallheaders();
		$this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
		$this->uri         = $_SERVER['REQUEST_URI'] ?? '';
	}

	/**
	 * [getHttpMethod description]
	 * @return [type] [description]
	 */
	public function getHttpMethod() {
		return $this->httpMethod;
	}

	/**
	 * [getURI description]
	 * @return [type] [description]
	 */
	public function getURI() {
		return $this->uri;
	}

	/**
	 * [getHeaders description]
	 * @return [type] [description]
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * [getQueryParams description]
	 * @return [type] [description]
	 */
	public function getQueryParams() {
		return $this->postsVars;
	}

	/**
	 * [getPostVars description]
	 * @return [type] [description]
	 */
	public function getPostVars() {
		return $this->queryParams;
	}

}

?>