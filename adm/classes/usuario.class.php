<?php
require_once 'conexao.class.php';

class Usuario
{
    private $con;

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $permissoes;

    public function __construct()
    {
        $this->con = new Conexao();
    }
    public function __set($atributo, $valor)
    {
        $this->atributo = $valor;
    }
    public function __get($atributo)
    {
        return $this->atributo;
    }
    //aqui ficará o CRUD de usuario

    //métodos do CRUD igual a Clientes

    //fim CRUD usuário.

    public function fazerLogin($email, $senha)
    {
        $sql = $this->con->conectar()->prepare("SELECT *FROM usuario WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $SESSION['logado'] = $sql['id']; //***importante***session é um usuario x com uma senha y est´´a logado, 

            // enquanto estiver logado o usuário vai estar ativo
            return TRUE;
        }
        return FALSE;
    }
    public function setUsuario($id)
    {
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT *FROM usuario WHERE $id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $this->permissoes = explode(',', $sql['permissoes']);
        }

    }
    public function getPermissoes(){
        return $this->permissoes;
    }
    public function temPermissoes($p){
        if(in_array($p, $this->permissoes)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
