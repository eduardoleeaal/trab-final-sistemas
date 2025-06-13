<?php 
require_once 'lock.php'; 
session_start(); // Garantir que a sessão está ativa
?>
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
        header('location:../restrita.php?codigo=0');
        exit;
    }

    if (campos_livro_em_branco()) { 
        header('location:../restrita.php?codigo=2');
        exit;
    }

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $id = (int)$_POST['id_livro']; // Forçar conversão para inteiro

    require_once 'conexao.php';
    $conn = conectar_banco();

    // Buscar o livro específico com validação de usuário
    $sqlLivro = "SELECT id_livro, titulo, descricao, usuario_id FROM tb_livros WHERE id_livro = ? AND usuario_id = ?";
    
    $stmt_validacao = mysqli_prepare($conn, $sqlLivro);
    mysqli_stmt_bind_param($stmt_validacao, "ii", $id, $_SESSION['id']);
    mysqli_stmt_execute($stmt_validacao);
    $resultado = mysqli_stmt_get_result($stmt_validacao);

    // Se não encontrou nenhum registro, significa que:
    // 1. O livro não existe OU
    // 2. O livro não pertence ao usuário logado
    if (mysqli_num_rows($resultado) <= 0) {
        mysqli_stmt_close($stmt_validacao);
        mysqli_close($conn);
        header('location:../restrita.php?codigo=1');
        exit;
    }

    mysqli_stmt_close($stmt_validacao);
    
    // Se chegou até aqui, o livro existe e pertence ao usuário
    // Pode proceder com a atualização
    $sql = "UPDATE tb_livros SET titulo = ?, descricao = ? WHERE id_livro = ? AND usuario_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        mysqli_close($conn);
        header('location:../restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssii", $titulo, $descricao, $id, $_SESSION['id']);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('location:../restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('location:../restrita.php'); 
    exit;
    ?>
</body>
</html>