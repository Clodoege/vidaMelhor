<?php
include 'classes/usuario.class.php';
$usuario = new Usuario();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = $_POST['permissoes'];
    $id = $_POST['id'];
    if (!empty($email)) {
        $usuario->editar($nome, $email, $senha, $permissoes, $senha, $id);
    }
    header("Location: gestao_usuarios.php");
}
