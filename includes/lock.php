<?php session_start();
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
        // Detectar se estamos em um arquivo da pasta includes ou da raiz
        $script_name = $_SERVER['SCRIPT_NAME'];
        
        if (strpos($script_name, '/includes/') !== false) {
            // Arquivo está na pasta includes
            header('location:../index.php?codigo=0');
        } else {
            // Arquivo está na raiz do projeto
            header('location:index.php?codigo=0');
        }
        exit;
        // codigo = 0 : sem permissão para acessar a página
    }
?>