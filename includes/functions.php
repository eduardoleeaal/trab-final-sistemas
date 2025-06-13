<?php

function form_nao_enviado() {
    return $_SERVER['REQUEST_METHOD'] !== 'POST';
}

function campos_em_branco() {
    return empty($_POST['usuario']) || empty($_POST['senha']);
}

function campos_livro_em_branco() {
    return empty($_POST['titulo']) || empty($_POST['descricao']);
}

function titulo_em_branco() {
    return empty($_POST['titulo']);
}

function id_nao_enviado() {
    return !isset($_GET['id']);
}

function verificar_codigo() {
    if (!isset($_GET['codigo'])) {
        return;
    }

    $codigo = (int)$_GET['codigo'];

    switch ($codigo) {
        case 0:
            $msg = '<div class="alert alert-danger"><h5>Você não tem permissão para acessar a página requisitada</h5></div>';
            break;

        case 1:
            $msg = '<div class="alert alert-danger"><h5>Usuário ou senha inválidos. Por favor, tente novamente!</h5></div>';
            break;

        case 2:
            $msg = '<div class="alert alert-warning"><h5>Por favor, preencha todos os campos do formulário</h5></div>';
            break;

        case 3:
            $msg = '<div class="alert alert-danger"><h5>Erro na estrutura da consulta SQL. Verifique com o suporte ou tente novamente mais tarde</h5></div>';
            break;

        case 4:
            $msg = '<div class="alert alert-danger"><h5>Erro ao excluir livro selecionado. Verifique com o suporte ou tente novamente mais tarde</h5></div>';
            break;

        case 5:
            $msg = '<div class="alert alert-danger"><h5>Erro ao cadastrar livro. Verifique com o suporte ou tente novamente mais tarde</h5></div>';
            break;
            
        case 6:
            $msg = '<div class="alert alert-success"><h5>Usuário criado com sucesso!</h5></div>';
            break;
            
        case 7:
            $msg = '<div class="alert alert-warning"><h5>Usuário já está logado</h5></div>';
            break;
            
        default:
            $msg = "";
            break;
    }

    echo $msg;
}

function incluir_form_login() {
    session_start();

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
        require_once 'form_login.php';
    }
}

?>