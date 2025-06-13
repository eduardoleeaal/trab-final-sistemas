<?php require_once 'lock.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="restrita.php">Biblioteca</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="restrita.php">Área Restrita</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php 
                require_once 'functions.php';
                verificar_codigo();

                if (!isset($_GET['id_livro'])) {
                    echo '<div class="alert alert-danger">ID do livro não fornecido!</div>';
                    exit;
                }

                $id = $_GET['id_livro'];
                require_once 'conexao.php';
                $conn = conectar_banco();

                if (!is_numeric($id) || $id <= 0) {
                    echo '<div class="alert alert-danger">ID inválido!</div>';
                    exit;
                }

                $query = "SELECT id_livro, titulo, descricao FROM tb_livros WHERE id_livro = " . (int)$id;
                $resultado = mysqli_query($conn, $query);
                $linhas_afetadas = mysqli_affected_rows($conn);

                if ($linhas_afetadas == 0) {
                    echo '<div class="alert alert-warning">Livro não encontrado!</div>';
                    exit;
                }

                if ($linhas_afetadas < 0) {
                    echo '<div class="alert alert-danger">Erro na consulta!</div>';
                    exit;
                }

                $livro = mysqli_fetch_assoc($resultado);
                ?>

                <div class="card">
                    <div class="card-header">
                        <h2>Editar Livro</h2>
                    </div>
                    <div class="card-body">
                        <form action="livro_editado.php" method="post">
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