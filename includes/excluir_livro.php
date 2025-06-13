<?php require_once 'lock.php';

if (!isset($_GET['id_livro']))  {
    header('location:../restrita.php');
    exit;
}

$id_livro = (int)$_GET['id_livro'];

// CORRIGIR: Incluir validação do usuário
$sql = "DELETE FROM tb_livros WHERE id_livro = ? AND usuario_id = ?";

require_once 'conexao.php';
$conn = conectar_banco();

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id_livro, $_SESSION['id']);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) <= 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('location:../restrita.php?codigo=4');
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
header('location:../restrita.php');
?>