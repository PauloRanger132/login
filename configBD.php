<?php
//configBD.php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "senai";

$connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($connect->connect_error) {
    die("Não Foi Possivel Conectar ao banco de dados: " . $connect->connect_error);
}
//echo "<h1>Sucesso, banco de dados conectado</h1>";
