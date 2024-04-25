<?php
include 'classes/clientes.class.php';
$cliente = new Clientes();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $foto = $_POST['foto'];
    $senha = $_POST['senha'];
    $id = $_POST['id'];
    if (!empty($email)) {
        $cliente->editar($nome, $email, $telefone, $cpf, $foto, $senha, $id);
    }
    header("Location: gestao_usuarios.php");
}
