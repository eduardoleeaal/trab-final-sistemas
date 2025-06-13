<?php require_once 'lock.php';

    require_once 'functions.php';

    if (form_nao_enviado()) {
        header('location:restrita.php?codigo=0');
        exit;
    }

    if (titulo_em_branco()) {
        header('location:restrita.php?codigo=2');
        exit;
    }

    $livro = $_POST['titulo'];
    $livro_descricao = $_POST['descricao']; // tarefa informada via form
    $id_usuario = $_SESSION['id']; // id do usuário registrado na sessão atual

    require_once 'conexao.php';

    $conn = conectar_banco();

    $sql = "INSERT INTO tb_livros (titulo, descricao, usuario_id) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        header('location:restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssi",  $livro, $livro_descricao, $id_usuario);

    if(!mysqli_stmt_execute($stmt)){
        header('location:restrita.php?codigo=3');
        exit;
    }

    mysqli_stmt_store_result($stmt); // armazena reusltado executado pelo comando

    if (mysqli_stmt_affected_rows($stmt) <= 0) {
        header('location:restrita.php?codigo=5');
        exit;
    }

    header('location:restrita.php');
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit;
?>