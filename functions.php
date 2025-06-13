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
            $msg = "<h3>Você não tem permissão para acessar a página requisitada</h3>";
            break;

        case 1:
            $msg = "<h3>Usuário ou senha inválidos. Por favor, tente novamente!</h3>";
            break;

        case 2:
            $msg = "<h3>Por favor, preencha todos os campos do form</h3>";
            break;

        case 3:
            $msg = "<h3>Erro na estrutura da consulta SQL. Verifique com o suporte ou 
            tente novamente mais tarde</h3>";
            break;

        case 4:
            $msg = "<h3>Erro ao excluir tarefa selecionada. Verifique com o suporte ou 
            tente novamente mais tarde</h3>";
            break;

        case 5:
            $msg = "<h3>Erro ao cadastrar tarefa. Verifique com o suporte ou 
            tente novamente mais tarde</h3>";
            break;
        case 6:
            $msg = "<h3>Usuário Criado com Sucesso</h3>";
            break;
        case 7:
            $msg = "<h3>Usuário já está logado</h3>";
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