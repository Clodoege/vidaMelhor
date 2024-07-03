<?php
session_start();

include 'classes/usuario.class.php';

$usuario = new Usuario();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $usuario->excluir($id);
    header("Location: gestao_usuarios.php");

}else{
    echo'<script type= "text/javascript">alert("Erro ao excluir usuario!);</script>';
    header("Location: /gestao_usuarios.php");
}