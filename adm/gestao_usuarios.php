<?php
include 'classes/usuario.class.php';
$cliente = new Usuario();
?>
<h1>Gestao de usuario Vida Melhor</h1>


<hr>
<button><a href="adicionarUsuario.php">ADICIONAR</a></button>
<br><br>
<table border="2" widht=100%>
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>SENHA</th>
        <th>PERMISSOES</th>
        
    </tr>
    <?php
    $lista = $usuario->listar();
    foreach($lista as $item) :
    ?>
        <tbody>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['senha']; ?></td>
                <td><?php echo $item['permissoes']; ?></td>
               
                <td>
                    <a href="editarUsuario.php?id=<?php echo $item['id']; ?>">EDITAR</a>
                    <a href="excluir.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que quer excluir este cliente?')">| EXCLUIR</a>
                </td>


            </tr>
        </tbody>
    <?php
    endforeach;
    ?>

</table>