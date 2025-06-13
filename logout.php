<?php session_start();
    unset($_SESSION); // apaga dados da variavel de sessão
    session_destroy(); // finaliza a sessão
    header('location:index.php');
?>