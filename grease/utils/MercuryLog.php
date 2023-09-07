<?php

define('PASTA_RAIZ', $_ENV['PASTA_RAIZ']);

class MercuryLog {
	
	private $path = PASTA_RAIZ . '/logs/';
	private $file = 'arquivo.log';

	public static function getPath() {
		$mercuryLog = new MercuryLog();
		return $mercuryLog->path . $mercuryLog->file; 
	}

	public static function create($level, $msg, $usuario, $folder) {
		$mercuryLog = new MercuryLog();

		$path_file = $mercuryLog->path . $folder . '/' .$mercuryLog->file;

		$data_de_agora = date('Y/m/d H:i:s');

		$mensagemFinal = "
		----------------------------------------
		[LEVEL]   => $level         \n
		[MSG]     => $msg           \n
		[USUARIO] => $usuario       \n
		[DATA]    => $data_de_agora \n
		----------------------------------------
		";

		error_log(
			$mensagemFinal,
			3, 
			$path_file
		);
	}

	public static function debug($msg, $usuario, $folder) {
		self::create('DEBUG', $msg, $usuario, $folder);
	}

	public static function info($msg, $usuario, $folder) {
		self::create('INFO', $msg, $usuario, $folder);
	}

	public static function warning($msg, $usuario, $folder) {
		self::create('WARNING', $msg, $usuario, $folder);
	}

	public static function error($msg, $usuario, $folder) {
		self::create('ERROR', $msg, $usuario, $folder);
	}

	public static function critical($msg, $usuario, $folder) {
		self::create('CRITICAL', $msg, $usuario, $folder);
	}
}
