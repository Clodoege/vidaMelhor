<?php
include 'classes/clientes.class.php';
$cliente = new Clientes();
if (!empty($_POST['email'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $foto = $_POST['foto'];
    $senha = $_POST['senha'];

    $cliente->adicionar($email, $nome, $telefone, $cpf,  $foto, $senha);
    header('Location: index.php');
} else {
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
