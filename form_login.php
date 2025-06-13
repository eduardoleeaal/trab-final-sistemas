<div class="mt-3">
    <h3>Login</h3>
    <form action="includes/validar.php" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário:</label>
            <input type="text" class="form-control" name="usuario" id="usuario" required>
        </div>
        
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" required>
        </div>

        <button type="submit" class="btn btn-success">Entrar</button>
    </form>
</div>