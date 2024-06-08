<?php
include 'classes/usuario.class.php';
$usuario = new Usuario();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $info = $usuario->buscar($id);
   
    if(empty($info['email'])){
        header("Location: gestao_usuarios.php");
        exit;
    }
}else{
    header("Location: gestao_usuarios.php");
    exit;
}
?>

<h1> EDITAR USUARIO</h1>
<
