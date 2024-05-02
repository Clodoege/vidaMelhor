<?php
require 'conexao.class.php';
class Exercicios
{
    private $id;
    private $nome;
    private $categoria;

    private $con;

    public function __construct(){
        $this->con = new Conexao();
    }

    public function adicionar($nome, $categoria){
        $this->nome = $nome;
        $this->categoria = $categoria;

        $sql = $this->con->conectar()->prepare("INSERT INTO exercicio(nome, categoria)values(:nome, :categoria)");


    }


}