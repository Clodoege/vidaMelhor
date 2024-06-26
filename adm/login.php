<?php
session_start();
require_once 'inc/header-inc.php';
require 'classes/usuario.class.php';



if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5($_POST['senha']);

    $usuario = new Usuario();

    if($usuario->fazerLogin($email, $senha)){
        header("Location: index.php");
        exit;
    }else{
        echo'<span style="color: red">'. "Usuario e/ou senha incorretos".'</span>';
    }
}
?>

<h1>Login Usuario</h1>
<form method="POST">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control">
    </div>
    <input type="submit" value="Fazer login" class= "btn btn-default">

</form>

<?php
require_once 'inc/footer-inc.php'
?>





