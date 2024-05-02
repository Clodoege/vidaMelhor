<?php
require 'conexao.class.php';  //para poder usar a classe conexao pelo banco de dados
class Clientes
{

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $cpf;
    private $foto;
    private $senha;

    private $con;

    public function __construct()
    {  // underline duplo considerado um comando mágico, ou seja, tem uma carta na manga pra facilitar a programação
        $this->con = new Conexao();
    }

    //vamos fazer uma validação pelo email, que é um atributo único, assim evitamos que haja duplicidade no cadastro de usuário
    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM cliente WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();  //comando fetch retorna apenas um registro que está no banco de dados, email no caso

        } else {
            $array = array();
        }
        return $array;
    }
    public function adicionar($email, $nome, $telefone, $cpf, $foto, $senha)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->email = $email;
                $this->telefone = $telefone;
                $this->cpf = $cpf;
                $this->foto = $foto;
                $this->senha = $senha;
                $sql = $this->con->conectar()->prepare("INSERT INTO cliente(nome, email, telefone, cpf, foto, senha)
                    VALUES(:nome, :email, :telefone, :cpf, :foto, :senha)");
                $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                $sql->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
                $sql->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
                $sql->bindParam(":foto", $this->foto, PDO::PARAM_STR);
                $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);

                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }
    }
    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT id, nome, email, telefone, cpf, foto, senha FROM cliente");
            $sql->execute();
            return $sql->fetchAll(); //fetchAll retorna todos os registros do banco
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }
    public function buscar($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch();  //fetch retorna apenas o
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }
    public function editar($nome, $email, $telefone, $cpf, $foto, $senha, $id)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE cliente SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, 
                foto = :foto, senha = :senha WHERE id = :id");
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':cpf', $cpf);
                $sql->bindValue(':foto', $foto);
                $sql->bindValue(':senha', $senha);
                $sql->bindValue(':id', $id);
                $sql->execute();

                return TRUE;
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }
    public function excluir($id)
    {
        $sql = $this->con->conectar()->prepare("DELETE FROM cliente where id= :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
