<?php
//conexao com o banco de dados
require_once 'configBD.php';

function verificar_entrada($entrada)
{
    //filtrando a entrada
    $saida = htmlspecialchars($entrada);
    $saida = stripslashes($saida);
    $saida = trim($saida);
    return $saida; //retorna a saida limpa
}
//teste se existe a ação
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'cadastro') {
        //teste se ação é igual a cadastro

        #echo "\n<p>cadastro</p>";
        #echo "\n<pre>";
        #print_r($_POST);
        #echo "\n</pre>";
        //pegando dados do formulario
        $nomeCompleto = verificar_entrada($_POST['nomeCompleto']);
        $nomeDoUsuario = verificar_entrada($_POST['nomeDoUsuario']);
        $emailUsuario = verificar_entrada($_POST['emailUsuario']);
        $senhaDoUsuario = verificar_entrada($_POST['senhaDoUsuario']);
        $senhaUsuarioConfirmar = verificar_entrada($_POST['senhaUsuarioConfirmar']);
        $dataCriado = date("Y-m-d"); // data atual no formato banco de dados

        //codificando as senhas
        $senhaCodificada = sha1($senhaDoUsuario);
        $senhaConfirmarCod = sha1($senhaUsuarioConfirmar);
        //teste de captura de dados
        echo "<p>Nome completo: $nomeCompleto </p>";
        echo "<p>Nome de Usuario: $nomeDoUsuario </p>";
        echo "<p>E-mail: $emailUsuario </p>";
        echo "<p>Senha codificada: $senhaCodificada</p>";
        echo "<p>Data de criação: $dataCriado</p>";
    } else if ($_POST['action'] == 'login') {
        //senão, teste se ação é login
        echo "<\np>login</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre>";
    } else if ($_POST['action'] == 'senha') {
        //senão, teste se ação é senha
        echo "<\np>senha</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre>";
    } else {

        header("location:index.php");
    }
} else {
    //redirecionando para index.php, negando o acesso
    //a esse arquivo diretamente.
    header("location:index.php");
}