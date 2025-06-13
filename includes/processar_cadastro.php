<?php
    session_start();
    require_once 'functions.php';
    verificar_codigo();

    if(form_nao_enviado()){
        header('location:../cadastrar_usuario.php?codigo=0');
        exit;
    }

    if(campos_em_branco()){
        header('location:../cadastrar_usuario.php?codigo=2');
        exit;
    }

    if(isset($_SESSION['usuario'])){
        header('location:../index.php?codigo=7');
        exit;
    }

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];

    require_once 'conexao.php';
    $conn = conectar_banco();

    $sql = "INSERT INTO tb_usuarios (usuario, senha, email) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        header('location:../cadastrar_usuario.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "sss", $usuario, $senha, $email);
    
    if (!mysqli_stmt_execute($stmt)) {
        header('location:../cadastrar_usuario.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:../cadastrar_usuario.php?codigo=5');
        exit;
    }
    header('location:../index.php?codigo=6');
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;   


?>