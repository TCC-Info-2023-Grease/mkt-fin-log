<?php  
namespace App\Http;

/**
 * Classe Response
 */
class Response {
	/**
	 * [$httpCode description]
	 * @var integer
	 */
	private $httpCode = 200;

	/**
	 * [$headers description]
	 * @var array
	 */
	private $headers = [];

	/**
	 * [$contentType description]
	 * @var string
	 */
	private $contentType = "text/html";

	/**
	 * [$content description]
	 * @var mixed
	 */
	private $content;


	/**
	 * [__construct description]
	 * @param integer $httpCode    [description]
	 * @param mixed $content     [description]
	 * @param string $contentType [description]
	 */
	public function __construct($_httpCode, $_content, $_contentType = "text/html") {
		$this->httpCode = $_httpCode;
		$this->content  = $_content;
		$this->setContenType($_contentType);
	}


	/**
	 * Método alterador do content type da response
	 * @param string $__contentType [description]
	 */
	public function setContenType($_contentType) {
		$this->contentType = $_contentType;
		$this->addHeader('content-Type', $_contentType);
	}


	/**
	 * [addHeader description]
	 * @param [type] $key   [description]
	 * @param [type] $value [description]
	 */
	public function addHeader($_key, $_value) {
		$this->headers[$_key] = $_value;
	}


	/**
	 * Responsavel por mandar os cabeçalhos para o navegador
	 * @return [type] [description]
	 */
	public function sendHeaders() {
		// STATUS HTTP
		http_response_code($this->httpCode);

		// ENVIAR HEADERS
		foreach ($this->headers as $key => $value) {
			$_header = $key .': '. $value;
			header($_header);
		}
	}


	/**
	 * Método responsavel por enviar a resposta ao usuario
	 * @return [type] [description]
	 */
	public function sendResponse() {
		// ENVIAR OS HEADERS
		$this->sendHeaders();

		// IMPRIME O CONTEUDO DE ACORDO COM SEU HEADER
		switch ($this->contentType) {
			case 'text/html':
				echo $this->content;
				exit;

			default:
				throw new Error("Not use this Content-Type");
				break;
		}
	}

}

?>
