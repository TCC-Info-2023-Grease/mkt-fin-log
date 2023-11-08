<?php

define('PASTA_RAIZ', $_ENV['PASTA_RAIZ']);

/**
 * Class MercuryLog
 *
 * This class provides methods for logging messages to a file.
 *
 * @since 2023-11-08
 * @author Bard <bard@example.com>
 */
class MercuryLog
{
    /**
     * The path to the log directory.
     *
     * @var string
     */
    private $path = PASTA_RAIZ . '/logs/';

    /**
     * The name of the log file.
     *
     * @var string
     */
    private $file = 'arquivo.log';

    /**
     * Gets the full path to the log file.
     *
     * @return string
     */
    public static function getPath()
    {
        $mercuryLog = new MercuryLog();
        return $mercuryLog->path . $mercuryLog->file;
    }

    /**
     * Creates a log entry.
     *
     * @param string $level The log level.
     * @param string $msg The log message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function create($level, $msg, $usuario, $folder)
    {
        $mercuryLog = new MercuryLog();

        $path_file = $mercuryLog->path . $folder . '/' . $mercuryLog->file;

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

    /**
     * Logs a debug message.
     *
     * @param string $msg The debug message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function debug($msg, $usuario, $folder)
    {
        self::create('DEBUG', $msg, $usuario, $folder);
    }

    /**
     * Logs an info message.
     *
     * @param string $msg The info message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function info($msg, $usuario, $folder)
    {
        self::create('INFO', $msg, $usuario, $folder);
    }

    /**
     * Logs a warning message.
     *
     * @param string $msg The warning message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function warning($msg, $usuario, $folder)
    {
        self::create('WARNING', $msg, $usuario, $folder);
    }

    /**
     * Logs an error message.
     *
     * @param string $msg The error message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function error($msg, $usuario, $folder)
    {
        self::create('ERROR', $msg, $usuario, $folder);
    }

    /**
     * Logs a critical message.
     *
     * @param string $msg The critical message.
     * @param string $usuario The user who logged the message.
     * @param string $folder The folder to store the log file in.
     */
    public static function critical($msg, $usuario, $folder)
    {
        self::create('CRITICAL', $msg, $usuario, $folder);
    }
}
