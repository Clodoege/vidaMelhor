<?php
include 'classes/clientes.class.php';
$cliente = new Clientes();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $cliente->excluir($id);
    header("Location: gestao_usuarios.php");
}else{
    echo '<script type= "text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /gestao_usuarios");
}