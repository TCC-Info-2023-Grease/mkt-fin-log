<?php
/**
 * Classe para depuração de código PHP
 *
 * @package ChamaSamu
 * @author [MrNullus] <[gustavojs417@gmail.com]>
 * @version 1.0
 *
*/
class ChamaSamu {

     /**
     * @method static void addDebugStyles()
     *
     * Adiciona estilos CSS à saída de depuração.
     *
     * @return void
     *
     * @since 2023-07-20
     * @author MrNullus <gustavojs417@gmail.com>
     */
      private static function addDebugStyles() {
          echo "<style>";
          echo "pre { background-color: #f5f5f5; padding: 10px; border: 1px solid #ccc; }";
          echo "table { border-collapse: collapse; }";
          echo "table, th, td { border: 1px solid #aaa; padding: 5px; }";
          echo "ul { list-style-type: disc; padding-left: 20px; }";
          echo "</style>";
      }
  
  
    /**
   * @method static void debugPanel(mixed $data)
   *
   * Exibe saída de depuração em uma janela flutuante. A janela flutuante contém uma cabeçalho com o título "Debug Panel" e uma área de texto que exibe o conteúdo dos dados fornecidos.
   *
   * @param mixed $data Dados a serem depurados.
   *
   * @throws Exception Se houver um erro ao exibir a saída de depuração.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com>
   *
   * @example
   *
   * // Exibe a saída de depuração de um array
   * Chamasamu\Debug::debugPanel([
   *     "nome" => "João",
   *     "idade" => 30,
   * ]);
   *
   * // Exibe a saída de depuração de um objeto
   * Chamasamu\Debug::debugPanel(new stdClass());
   */
      public static function debugPanel($data) {
          self::addDebugStyles();
          echo '<div class="chamasamu-debug-panel">';
          echo '<h3>Debug Panel</h3>';
          echo '<pre>';
          print_r($data);
          echo '</pre>';
          echo '</div>';
      }
  
   /**
   * @method static void debug(mixed $data)
   *
   * Outputs debug information in a preformatted code block.
   *
   * @param mixed $data Data to be debugged.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com>
   *
   * @example
   *
   * // Outputs debug information for an array
   * Chamasamu\Debug::debug([
   *     "name" => "John",
   *     "age" => 30,
   * ]);
   *
   * // Outputs debug information for an object
   * Chamasamu\Debug::debug(new stdClass());
   */
    public static function debug($data) {
        self::addDebugStyles();
        echo "<pre><code>";
        var_dump($data);
        echo "</code></pre>";
    }
    
    /**
     * @method static void debugJSON(mixed $data)
     *
     * Outputs debug information as JSON in a preformatted code block.
     *
     * @param mixed $data Data to be debugged.
     *
     * @link https://www.php.net/manual/en/function.json-encode.php
     *
     * @return void
     *
     * @since 2023-07-20
     * @author MrNullus <gustavojs417@gmail.com
     *
     * @example
     *
     * // Outputs debug information as JSON for an array
     * Chamasamu\Debug::debugJSON([
     *     "name" => "John",
     *     "age" => 30,
     * ]);
     *
     * // Outputs debug information as JSON for an object
     * Chamasamu\Debug::debugJSON(new stdClass());
     */
      public static function debugJSON($data) {
          self::addDebugStyles();
          echo "<pre>";
          echo json_encode($data, JSON_PRETTY_PRINT);
          echo "</pre>";
      }
  
    
     /**
   * @method static void session()
   *
   * Outputs the current session data. Session data is a way to store information across different pages in a web application. To enable session data, you must call the `session_start()` function at the beginning of every page that you want to use session data on. To disable session data, you must call the `session_destroy()` function at the end of every page that you want to use session data on.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @example
   *
   * // Enable session data
   * session_start();
   *
   * // Store a value in the session data
   * $_SESSION['name'] = "John";
   *
   * // Output the current session data
   * Chamasamu\Debug::session();
   *
   * // Destroy the session data
   * session_destroy();
   */
    public static function session()
    {
        self::debug($_SESSION);
    }
  
  
      /**
   * @method static void get()
   *
   * Outputs the current GET request parameters.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   */
  public static function get()
  {
      self::debug($_GET);
  }
  
  
     /**
   * @method static void post()
   *
   * Exibe saída de depuração do array POST. O array POST é usado para passar dados de um formulário HTML para um servidor web. Para acessar o array POST em PHP, você pode usar a superglobal `$_POST`. Cada valor do array POST é armazenado como uma chave-valor, onde a chave é o nome do campo do formulário e o valor é o valor do campo.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @example
   *
   * // Crie um formulário HTML
   * <form action="/" method="post">
   *     <input type="text" name="name" />
   *     <input type="submit" value="Enviar" />
   * </form>
   *
   * // Acesse o valor do campo "name" do formulário
   * $name = $_POST['name'];
   *
   * // Exibe a saída de depuração do array POST
   * Chamasamu\Debug::post();
   */
  public static function post()
  {
      self::debug($_POST);
  }
  
  
     /**
   * @method static void code(string $code)
   *
   * Exibe saída de depuração de código com formatação.
   *
   * @param string $code Código a ser depurado.
   *
   * @return void
   *
  * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/function.highlight-string.php
   *
   * @example
   *
   * // Exibe a saída de depuração de um código PHP
   * Chamasamu\Debug::code('
   *     $name = "John";
   *     echo "Olá, $name!";
   * ');
   */
  public static function code($code)
  {
      self::addDebugStyles();
      echo "<pre>";
      highlight_string($code);
      echo "</pre>";
  }
  
  
       /**
   * @method static void debugObject(object $object)
   *
   * Exibe saída de depuração de um objeto em formato legível.
   *
   * @param object $object Objeto a ser depurado.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/function.print-r.php
   *
   * @example
   *
   * // Exibe a saída de depuração de um objeto PHP
   * Chamasamu\Debug::debugObject(new stdClass());
   */
  public static function debugObject($object)
  {
      self::addDebugStyles();
      echo "<pre><code>";
      print_r($object);
      echo "</code></pre>";
  }
  
  
     /**
   * @method static void debugSQL(string $sql)
   *
   * Exibe saída de depuração de uma consulta SQL.
   *
   * Uma consulta SQL é uma sequência de instruções que são usadas para acessar ou manipular dados em um banco de dados. Para depurar consultas SQL em PHP, você pode usar a função `var_dump()`.
   *
   * @param string $sql Consulta SQL a ser depurada.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/function.var-dump.php
   *
   * @example
   *
   * // Crie uma conexão com um banco de dados
   * $connection = new PDO("mysql:host=localhost;dbname=my_database", "username", "password");
   *
   * // Crie uma consulta SQL
   * $sql = "SELECT * FROM users";
   *
   * // Executa a consulta SQL
   * $result = $connection->query($sql);
   *
   * // Depura a consulta SQL
   * Chamasamu\Debug::debugSQL($sql);
   */
  public static function debugSQL($sql)
  {
      self::addDebugStyles();
      echo "<pre>";
      echo "SQL Query: " . $sql;
      echo "</pre>";
  }
  
  
   /**
   * @method static void debugMessage(string $message)
   *
   * Exibe saída de depuração de mensagens personalizadas.
   *
   * Uma mensagem de depuração é uma mensagem que é usada para ajudar a depurar um código. Para depurar mensagens personalizadas em PHP, você pode usar o método `debugMessage()`.
   *
   * @param string $message Mensagem a ser depurada.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/function.var_dump.php
   *
   * @example
   *
   * // Crie uma mensagem de depuração
   * $message = "Esta é uma mensagem de depuração.";
   *
   * // Depura a mensagem
   * Chamasamu\Debug::debugMessage($message);
   */
  public static function debugMessage($message)
  {
      self::addDebugStyles();
      echo "<pre>";
      echo "Message: " . $message;
      echo "</pre>";
  }
  
  
      /**
   * @method static void debugAssociativeArray(array $array)
   *
   * Exibe saída de depuração de um array associativo com chave e valor.
   *
   * Um array associativo é um array que usa chaves para acessar seus valores. Para depurar arrays associativos em PHP, você pode usar a função `foreach()`.
   *
   * @param array $array Array associativo a ser depurado.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/control-structures.foreach.php
   *
   * @example
   *
   * // Crie um array associativo
   * $array = [
   *     "name" => "John",
   *     "age" => 30,
   *     "city" => "São Paulo"
   * ];
   *
   * // Depura o array associativo
   * Chamasamu\Debug::debugAssociativeArray($array);
   */
  public static function debugAssociativeArray($array)
  {
      self::addDebugStyles();
      echo "<pre>";
      foreach ($array as $key => $value) {
          echo "$key: $value<br>";
      }
      echo "</pre>";
  }
  
  /**
   * @method static void debugBoolean(bool $bool)
   *
   * Exibe saída de depuração de uma variável booleana.
   *
   * Uma variável booleana pode ter dois valores: true ou false. Para depurar variáveis booleanas em PHP, você pode usar o operador ternário.
   *
   * @param bool $bool Variável booleana a ser depurada.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/language.operators.ternary.php
   *
   * @example
   *
   * // Crie uma variável booleana
   * $bool = true;
   *
   * // Depura a variável booleana
   * Chamasamu\Debug::debugBoolean($bool);
   */
  public static function debugBoolean($bool)
  {
      self::addDebugStyles();
      echo "<pre>";
      echo "Boolean: " . ($bool ? 'true' : 'false');
      echo "</pre>";
  }
  
  
    /**
   * @method static void debugXML(string $data)
   *
   * Displays debugging output of a variable in XML format.
   *
   * An XML variable is a string that contains XML data. To debug XML variables in PHP, you can use the `DOMDocument` class.
   *
   * @param string $data Variable to be debugged.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/class.domdocument.php
   *
   * @example
   *
   * // Create an XML variable
   * $data = '<xml><element>Value</element></xml>';
   *
   * // Debug the XML variable
   * Chamasamu\Debug::debugXML($data);
   */
  public static function debugXML($data)
  {
      self::addDebugStyles();
      echo "<pre>";
      $doc = new DOMDocument('1.0');
      $doc->preserveWhiteSpace = false;
      $doc->formatOutput = true;
      $doc->loadXML($data);
      echo htmlentities($doc->saveXML());
      echo "</pre>";
  }
    
  
  /**
   * @method static void debugTable(array $data)
   *
   * Displays debugging output of a variable in HTML table format.
   *
   * An HTML table is a way of representing tabular data in HTML. To debug variables in HTML table format in PHP, you can use the `echo` statement.
   *
   * @param array $data Variable to be debugged.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/language.basic-syntax.php
   *
   * @example
   *
   * // Create an array to be debugged
   * $data = [
   *     ['Name', 'Age'],
   *     ['John', 30],
   *     ['Jane', 25],
   * ];
   *
   * // Debug the array
   * Chamasamu\Debug::debugTable($data);
   */
  public static function debugTable($data)
  {
      self::addDebugStyles();
      echo "<table border='1' cellspacing='0'>";
      foreach ($data as $row) {
          echo "<tr>";
          foreach ($row as $cell) {
              echo "<td>" . htmlentities($cell) . "</td>";
          }
          echo "</tr>";
      }
      echo "</table>";
  }

  
   /**
   * @method static void debugList(array $data)
   *
   * Displays debugging output of a variable in HTML list format.
   *
   * An HTML list is a way of representing a list of items in HTML. To debug variables in HTML list format in PHP, you can use the `echo` statement.
   *
   * @param array $data Variable to be debugged.
   *
   * @return void
   *
   * @since 2023-07-20
   * @author MrNullus <gustavojs417@gmail.com
   *
   * @link https://www.php.net/manual/en/language.basic-syntax.php
   *
   * @example
   *
   * // Create an array to be debugged
   * $data = [
   *     'John',
   *     'Jane',
   *     'Mary',
   * ];
   *
   * // Debug the array
   * Chamasamu\Debug::debugList($data);
   */
  public static function debugList($data)
  {
      self::addDebugStyles();
      echo "<ul>";
      foreach ($data as $item) {
          echo "<li>" . htmlentities($item) . "</li>";
      }
      echo "</ul>";
  }

}
