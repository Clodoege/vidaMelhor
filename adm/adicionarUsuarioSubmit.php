<?php
include 'classes/usuario.class.php';

$usuario = new Usuario();
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = implode(",", $_POST['permissoes']);

    $usuario->adicionar($email, $nome, $senha, $permissoes);
    header('Location: gestao_usuarios.php');

}else{
    echo 'script type= "text/javascript">alert("Email já cadastrado!");</script>';
}