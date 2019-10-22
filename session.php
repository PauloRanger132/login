<?php
session_start();
require_once "configBD.php";

if (isset($_SESSION['nomeDoUsuario'])) {
    //logado

} else {
    //Senão estiver logado, rediricionar para index
    header("location: index.php");
}
