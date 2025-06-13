<?php require_once 'includes/lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="restrita.php">Biblioteca</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="restrita.php">Área Restrita</a>
                <a class="nav-link" href="includes/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php 
                require_once 'includes/functions.php';
                verificar_codigo();

                if (!isset($_GET['id_livro'])) {
                    echo '<div class="alert alert-danger">ID do livro não fornecido!</div>';
                    exit;
                }

                $id = $_GET['id_livro'];
                require_once 'includes/conexao.php';
                $conn = conectar_banco();

                if (!is_numeric($id) || $id <= 0) {
                    echo '<div class="alert alert-danger">ID inválido!</div>';
                    exit;
                }

                // CORRIGIR: Incluir validação do usuário
                $query = "SELECT id_livro, titulo, descricao FROM tb_livros WHERE id_livro = ? AND usuario_id = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "ii", $id, $_SESSION['id']);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($resultado) == 0) {
                    echo '<div class="alert alert-danger">Livro não encontrado ou você não tem permissão para editá-lo!</div>';
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit;
                }

                $livro = mysqli_fetch_assoc($resultado);
                mysqli_stmt_close($stmt);
                ?>

                <div class="card">
                    <div class="card-header">
                        <h2>Editar Livro</h2>
                    </div>
                    <div class="card-body">
                        <form action="./includes/livro_editado.php" method="post">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" 
                                       value="<?= htmlspecialchars($livro['titulo']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <textarea class="form-control" name="descricao" id="descricao" rows="3" required><?= htmlspecialchars($livro['descricao']); ?></textarea>
                            </div>

                            <input type="hidden" name="id_livro" value="<?= $id; ?>">

                            <button type="submit" class="btn btn-warning">Salvar</button>
                            <a href="restrita.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>