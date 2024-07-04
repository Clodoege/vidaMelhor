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
    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email= :email");
        $sql->bindParam(':email',$email, PDO::PARAM_STR);
        $sql->execute();

        if($sql->rowcount() > 0){
            $array = $sql->fetch();
        } else{
            $array = array();
        }
        return $array;
    }
    public function adicionar($email, $nome, $senha, $permissoes){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) == 0){
            try{
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = $senha;
                $this->permissoes = $permissoes;
                $sql = $this->con->conectar()->prepare("INSERT INTO usuario(nome, email,senha, permissoes)
                    VALUES (:nome, :email, :senha, :permissoes)");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                $sql->bindParam("permissoes", $this->permissoes, PDO::PARAM_STR);

                $sql-> execute();
                return TRUE;
            
            } catch (PDOException $ex){
                  return 'ERRO: '. $ex->getMessage();
            }
        } else {
             return FALSE;
        }
    }
    public function listar()
    {
        try{
            $sql = $this->con->conectar()->prepare("SELECT id, nome, email, senha, permissoes FROM usuario");
            $sql->execute();
            return $sql->fetchAll();
        }catch (PDOException $ex){
            return 'ERRO: '. $ex->getMessage();
        }
    }
    public function buscar($id)
    {
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if($sql->rowCount() > 0){
                return $sql->fetch();
            } else{
                return array();
            }
        } catch (PDOException $ex){
            echo "ERRO: ". $ex->getMessage();
        }
    }
    public function editar($id, $nome, $email, $permissoes)
    {
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) > 0 && $emailExistente['id'] != $id){
            return FALSE;
        }else {
            try{
                $sql = $this->con->conectar()->prepare("UPDATE usuario SET nome = :nome, email = :email, permissoes = :permissoes WHERE id = :id");
                $sql->bindValue(':id', $id);
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':permissoes', $permissoes);
               
                $sql->execute();

                return TRUE;
            }catch (PDOException $ex){
                echo 'ERRO: '.$ex->getMessage();
            }
        }

    }
    public function excluir($id)
    {
        $sql = $this->con->conectar()->prepare("DELETE FROM usuario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

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
    public function buscaPermissaoSuper($arrayperm){
        foreach($arrayperm as $item){
            if($item == "super"){
                return true;
            }
        }
    }
    public function buscaPermissaoAdd($arrayperm){
        foreach($arrayperm as $item){
            if($item == "add"){
                return true;
            }
        }
    }
    public function buscaPermissaoDel($arrayperm){
        foreach($arrayperm as $item){
            if($item == "del"){
                return true;
            }
        }

    }
    public function buscaPermissaoEdit($arrayperm){
        foreach($arrayperm as $item){
            if($item == "edit"){
                return true;
            }
        }
    }
}
