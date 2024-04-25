<?php
include 'classes/clientes.class.php';
$cliente = new Clientes();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $cliente->buscar($id);
    if (empty($info['email'])) {
        header("Location: gestao_usuario.php");
        exit;
    }
} else {
    header("Location: gestao_usuario.php");
    exit;
}
?>

<h1>EDITAR CLIENTE</h1>
<form method="POST" action="editarClienteSubmit.php">
    <input type="hidden" name="id" value="<?php echo $info['id'] ?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info['nome'] ?>" /> <br><br>
    Email: <br>
    <input type="text" name="email" value="<?php echo $info['email'] ?>" /><br><br>
    Telefone: <br>
    <input type="text" name="telefone" value="<?php echo $info['telefone'] ?>" /><br><br>
    Cpf: <br>
    <input type="text" name="cpf" value="<?php echo $info['cpf'] ?>" /><br><br>
    Foto: <br>
    <input type="text" name="foto" value="<?php echo $info['foto'] ?>" /><br><br>
    Senha:<br>
    <input type="text" name="senha" value="<?php echo $info['senha'] ?>" /><br><br>

    <input type="submit" name="btCadastrar" value="SALVAR" />
</form>