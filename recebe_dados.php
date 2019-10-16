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
        
        // echo "<p>Nome completo: $nomeCompleto </p>";
        // echo "<p>Nome de Usuario: $nomeDoUsuario </p>";
        //echo "<p>E-mail: $emailUsuario </p>";
        //echo "<p>Senha codificada: $senhaCodificada</p>";
        //echo "<p>Data de criação: $dataCriado</p>";

        if ($senhaCodificada != $senhaConfirmadaCod){
            echo "<p class='text-danger'>Senhas não conferem.</p>";
            exit();
        }else{
            //As senhas conferem, verificar se o usuário já
            //existe no banco de dados
            $sql = $connect ->prepare("SELECT nomeDoUsuaraio, emailUsuario
            FROM usuario WHERE nomeDoUsuario = ? OR emailUsuario = ?");
            $sql->bind_param("ss", $nomeDoUsuario, $emailUsuario);
            $sql->execute();
            $resultado = $sql->get_result();
            $linha = $resultado->fetch_array(MYSQLI_ASSOC);

        if ($linha['nomeDoUsuario'] == $nomeDoUsuario){
                echo "<p class='text-danger'> Usuário indisponível</p>";
            }else($linha['emailUsuario'] == $emailUsuario);
                echo "<p class='text-danger'>E-mail indisponível </p>";
            }else {
                //Usuário pode ser cadastrado no banco de cados
                $sql = $connect->prepare("INSERT into usuario (nomeDoUsuario, nomecompleto, emailUsuario, senhaDoUsuario, dataCriado) values( ?,?,?,?,?)");
                $sql->bind_param("sssss", $senhaDoUsuario, $nomeCompleto, $emailUsuario, $senhaCodificada,$dataCriado);
                if($sql->execute()){
                    echo "<p class='text-success'>Usuário cadastrado</p>";
                }else{
                    echo "<p class='text-danger'>Usuário não cadastrado</p>";
                    echo "<p class='text-danger'>Algo deu errado</p>";
                }
            }

        }
        } if ($_POST['action'] == 'login') {
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
}



//btn btn-info btn-block
