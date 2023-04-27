
<?php

$conn = new mysqli("localhost", "root", "", "cx_tcc");

if ($conn -> connect_error){
    echo "Erro: " . $conn -> connect_error;
}
else{
    echo "Banco de dados CONECTADO!";
}

//$consulta = $conn -> querry("SELECT * FROM tbpessoa ORDER BY nome");

//função prepare() prepara um comando que voc^Çe quer enviar para o banco de dados. as interrogações são as informações que eu vou passar para o BD.
$stmt = $conn -> prepare("INSERT INTO Usuarios(nome, form, valor, tp) VALUES (?, ?, ?, ?)");


//função bind_param faz um pareamento entre o conteudo das variaveis locais e das variaveis de transferências e cria uma blindagem para transferir as informações para o banco de dados.
$stmt -> bind_param("ssis", $nome, $form, $valor, $tp);
//"s" - string. "i" - int. "d" - double. "b" - bloob, etc.

/*
$nome = 'Margarida';
$tel = '96666-66666';
$email = 'margarida@gmail.com';
*/

    $nome = $_POST['fnome'];
    $form = $_POST['fform'];
    $valor = $_POST['fvalor'];
    $tp = $_POST['ftp'];



/*função execute() executa todos os comandos agendados pela função prepare() para o banco de dados
*/

$stmt -> execute();
?>