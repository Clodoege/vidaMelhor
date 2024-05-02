<?php
include 'classes/clientes.class.php';
$cliente = new Clientes();
?>
<h1>Gestao de usuario Vida Melhor</h1>


<hr>
<button><a href="adicionarCliente.php">ADICIONAR</a></button>
<br><br>
<table border="2" widht=100%>
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>TELEFONE</th>
        <th>CPF</th>
        <th>FOTO</th>
        <th>AÇÕES</th>
    </tr>
    <?php
    $lista = $cliente->listar();
    foreach($lista as $item) :
    ?>
        <tbody>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['telefone']; ?></td>
                <td><?php echo $item['cpf']; ?></td>
                <td><?php echo $item['foto']; ?></td>
                <td>
                    <a href="editarCliente.php?id=<?php echo $item['id']; ?>">EDITAR</a>
                    <a href="excluirCliente.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que quer excluir este cliente?')">| EXCLUIR</a>
                </td>


            </tr>
        </tbody>
    <?php
    endforeach;
    ?>

</table>