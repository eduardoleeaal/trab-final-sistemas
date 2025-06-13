<?php 
function conectar_banco() {

    $servidor   = 'localhost:3306'; 
    $usuario    = 'root';
    $senha      = '';
    $banco      = 'bd_biblioteca';   
    
    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conn) {
        // Debug mais detalhado para Fedora
        $erro = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        exit("Erro na conexão - Código: $errno - Mensagem: $erro");
    }

    // Definir charset para evitar problemas com acentos
    mysqli_set_charset($conn, 'utf8mb4');

    return $conn;
}
?>
