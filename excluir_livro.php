<?php require_once 'lock.php';

    if (!isset($_GET['id_livro']))  {
        header('location:restrita.php');
        exit; // impede que outro trecho de códig seja executado após o redirecionamento
    }

    $id_livro = (int)$_GET['id_livro']; // força o parâmetro a ser int

    $sql = "DELETE FROM tb_livros WHERE id_livro = $id_livro";

    require_once 'conexao.php';

    $conn = conectar_banco();

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) <= 0) {
        header('location:restrita.php?codigo=4');
        exit;
    }

    header('location:restrita.php');

?>