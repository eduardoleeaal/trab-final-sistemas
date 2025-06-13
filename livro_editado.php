<?php require_once 'lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro editado</title>
</head>
<body>
    <?php 
    require_once 'functions.php';
    verificar_codigo();

    if (form_nao_enviado()) {
        header('location:restrita.php?codigo=0');
        exit;
    }

    if (campos_livro_em_branco()) { 
        header('location:restrita.php?codigo=2');
        exit;
    }

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id = $_POST['id_livro'];

    require_once 'conexao.php';
    $conn = conectar_banco();
    
    $sql = "UPDATE tb_livros SET titulo = ?, descricao = ? WHERE id_livro = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        header('location:restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssi", $titulo, $descricao, $id);

    if (!mysqli_stmt_execute($stmt)) {
        header('location:restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('location:restrita.php'); 
    exit;


    ?>
</body>
</html>