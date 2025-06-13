<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Biblioteca</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="restrita.php">Área Restrita</a>
                <a class="nav-link" href="cadastrar_usuario.php">Cadastrar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1>Sistema de Biblioteca</h1>
                    </div>
                    <div class="card-body">
                        <h4>Bem-vindo!</h4>
                        <p>Gerencie sua biblioteca pessoal.</p>
                        <p>Desenvolvido por: <b>Eduardo Leal</b> e <b>Matheus Navalski</b></p>
                        
                        <?php 
                        require_once 'functions.php';
                        verificar_codigo();
                        incluir_form_login();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>