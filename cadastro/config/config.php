<?php


#Nome do WebSite
$nome_webSite = "L2Teste";

#Nome do Servidor
$nome_server = "L2Teste";

#Endereço do site
#ex: www.testando.com/
$link_site = "www.testando.com/";

#Email do remetente
$email_remetente = 'L2teste@hotmail.com';

#Minimo e máximo de caracteres no campo Nome Completo
$min_nome_completo = 6;
$max_nome_completo = 23;

#Mínimo e máximo de caracteres no Campo Login
$min_login = 4;
$max_login = 12;

#Mínimo e máximo de caracteres no campo Senha
$min_senha = 4;
$max_senha = 14;

// Configurações do banco de dados
$hostname = "localhost";
$username = "root";
$password = "Mlkzika013@";
$database = "acis";

// Criando a conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verificando se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>