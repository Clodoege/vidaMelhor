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
/*if (!isset($_SESSION['logado'])) {
    header("Location: gestao_usuarios.php");
    exit;
}*/
?>

<h1> EDITAR USUARIO</h1>
<form method="POST" action="editarUsuarioSubmit.php">
    <input type="hidden" name="id" value="<?php echo $info['id'] ?>"/>
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info['nome'] ?>" /> <br><br>
   
    Email: <br>
    <input type="text" name="email" value="<?php echo $info['email'] ?>" /><br><br>
    
    Senha:<br>
    <input type="text" name="senha" value="<?php echo $info['senha'] ?>" /><br><br>
   
    
    <label for= permissoes>Permissões:</label><br>
        <?php if ($usuario->buscaPermissaoAdd($arrayperm)) : ?>
            <input type="checkbox" id="add" name="permissoes[]" value="add" checked> 
            <label for= "add">ADICIONAR</label>
        <?php endif; ?>
        <?php if (empty($usuario->buscaPermissaoAdd($arrayperm))) : ?>
            <input type="checkbox" id="add" name="permissoes[]" value="add"> 
            <label for= "add">ADICIONAR</label>
        <?php endif; ?>
   
        <?php if ($usuario->buscaPermissaoEdit($arrayperm)) : ?>
            <input type="checkbox" id="edit" name="permissoes[]" value="edit" checked> 
            <label for= "edit">EDITAR</label>
        <?php endif; ?>
        <?php if (empty($usuario->buscaPermissaoEdit($arrayperm))) : ?>
            <input type="checkbox" id="edit" name="permissoes[]" value="edit"> 
            <label for= "edit">EDITAR</label>
        <?php endif; ?>

        <?php if ($usuario->buscaPermissaoDel($arrayperm)) : ?>
            <input type="checkbox" id="del" name="permissoes[]" value="del" checked> 
            <label for= "del">EXCLUIR</label>
        <?php endif; ?>
        <?php if (empty($usuario->buscaPermissaoDel($arrayperm))) : ?>
            <input type="checkbox" id="del" name="permissoes[]" value="del"> 
            <label for= "del">EXCLUIR</label>
        <?php endif; ?>

        <?php if ($usuario->buscaPermissaoSuper($arrayperm)) : ?>
            <input type="checkbox" id="super" name="permissoes[]" value="super" checked> 
            <label for= "super">SUPER</label>
        <?php endif; ?>
        <?php if (empty($usuario->buscaPermissaoSuper($arrayperm))) : ?>
            <input type="checkbox" id="super" name="permissoes[]" value="super"> 
            <label for= "super">SUPER</label>
        <?php endif; ?>
    

    <input type="submit" name="btCadastrar" value="SALVAR" />

</form>