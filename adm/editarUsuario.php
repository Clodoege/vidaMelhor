<?php
session_start();
include 'classes/usuario.class.php';

$usuario = new Usuario();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $info = $usuario->buscar($id);
   
    if(empty($info['email'])){
        header("Location: gestao_usuarios.php");
        exit;
    }
    $arrayperm = explode(",", $info['permissoes']);
}else{
    header("Location: gestao_usuarios.php");
    exit;
}
?>

<h1> EDITAR USUARIO</h1>
<form method="POST" action="editarUsuarioSubmit.php">
    <input type="hidden" name="id" value="<?php echo $info['id'] ?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info['nome'] ?>" /> <br><br>
   
    Email: <br>
    <input type="text" name="email" value="<?php echo $info['email'] ?>" /><br><br>
    
    Senha:<br>
    <input type="text" name="senha" value="<?php echo $info['senha'] ?>" /><br><br>
   
    Permissoes:<br>
    <label for="add">
        <?php if ($usuario->buscaPermissaoAdd($arrayperm)) : ?>
            <input type="checkbox" id="add" name="permissoes[]" value="add" checked> Adicionar
        <?php endif; ?>
    </label>
    
    <label for="add">
        <?php if (empty($usuario->buscaPermissaoAdd($arrayperm))) : ?>
            <input type="checkbox" id="add" name="permissoes[]" value="add"> Adicionar
        <?php endif; ?>
    </label>
   
    <label for="edit">
        <?php if ($usuario->buscaPermissaoEdit($arrayperm)) : ?>
            <input  id="edit" type="checkbox" name="permissoes[]" value="edit" checked> Editar
        <?php endif; ?>
    </label>
   
    <label for="edit">
        <?php if (empty($usuario->buscaPermissaoEdit($arrayperm))) : ?>
            <input  id="edit" type="checkbox" name="permissoes[]" value="edit"> Editar
        <?php endif; ?>
    </label>

    <label for="del">
        <?php if ($usuario->buscaPermissaoDel($arrayperm)) : ?>
            <input  id="del" type="checkbox" name="permissoes[]" value="del" checked> Deletar
        <?php endif; ?>
    </label>
   
    <label for="del">
        <?php if (empty($usuario->buscaPermissaoDel($arrayperm))) : ?>
            <input  id="del" type="checkbox" name="permissoes[]" value="del"> Deletar
        <?php endif; ?>
    </label>
   
    <label for="super">
        <?php if ($usuario->buscaPermissaoSuper($arrayperm)) : ?>
            <input  id="super" type="checkbox" name="permissoes[]" value="super" checked> Super
        <?php endif; ?>
    </label>
   
    <label for="super">
        <?php if (empty($usuario->buscaPermissaoSuper($arrayperm))) : ?>
            <input  id="super" type="checkbox" name="permissoes[]" value="super"> Super
        <?php endif; ?>
    </label><br><br>

    <input type="submit" name="btCadastrar" value="SALVAR" />

</form>