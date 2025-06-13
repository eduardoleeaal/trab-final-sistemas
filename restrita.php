<?php require_once 'includes/lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Biblioteca</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="includes/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Bem-vindo, <?= $_SESSION['usuario'] ?>!</h2>
        
        <div class="card mt-3">
            <div class="card-header">
                <h4>Cadastrar Novo Livro</h4>
            </div>
            <div class="card-body">
                <form action="./includes/cadastrar_livros.php" method="post">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <input type="text" class="form-control" name="descricao" id="descricao" required>
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </form>
            </div>
        </div>

        <?php
        require_once 'includes/functions.php';
        verificar_codigo();

        $id = $_SESSION['id'];
        $sql = "SELECT id_livro, titulo, descricao FROM tb_livros
                INNER JOIN tb_usuarios
                ON tb_livros.usuario_id = tb_usuarios.id 
                WHERE usuario_id = $id";
        
        require_once 'includes/conexao.php';
        $conn = conectar_banco();
        $resultado = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) <= 0) {
            echo '<div class="alert alert-warning mt-3">
                    <h4>Nenhum livro cadastrado ainda!</h4>
                  </div>';
        } else {
            echo '<div class="mt-4">
                    <h4>Seus Livros</h4>
                    <div class="row">';

            while($livro = mysqli_fetch_assoc($resultado)) {
                $id_livro = $livro['id_livro'];
                $livro_atual = $livro['titulo'];
                $livro_descricao = $livro['descricao'];

                echo '<div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($livro_atual) . '</h5>
                                <p class="card-text">' . htmlspecialchars($livro_descricao) . '</p>
                                <a href="editar_livro.php?id_livro='.$id_livro.'" class="btn btn-warning btn-sm">Editar</a>
                                <a href="./includes/excluir_livro.php?id_livro='.$id_livro.'" class="btn btn-danger btn-sm" 
                                   onclick="return confirm(\'Excluir este livro?\')">Excluir</a>
                            </div>
                        </div>
                      </div>';
            }
            echo '</div></div>';
        }
        ?>
    </div>
</body>
</html>