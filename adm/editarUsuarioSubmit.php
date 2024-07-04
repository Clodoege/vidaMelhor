<?php
include 'classes/usuario.class.php';
$usuario = new Usuario();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
   
    $permissoes = implode(",", $_POST['permissoes']);
    $id = $_POST['id'];
    if (!empty($email)) {
        $usuario->editar($id, $nome, $email, $permissoes);
    }
    header("Location: gestao_usuarios.php");
}
