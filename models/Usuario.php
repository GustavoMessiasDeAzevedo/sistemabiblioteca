<?php


class Usuario{


    protected $db;
    protected $table = "usuarios"; 

    public function __construct()
    {
        $this->db = DBConexao::getConexao();
    }

    /**
    *@param int $id;
    *@return Usuario;

    */
    public function buscar($id){


        try{
            $query = "SELECT * FROM {$this->table} WHERE id_usuario = :id";
            $stmt = $this->db->prepare($query);
        }catch(PDOException $e){
            echo "Erro na preparação da consulta: ". $e->getMessage();
        }

         $stmt ->bindParam(':id', [$id]);

         try{
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if($usuario){

                //Vai ser substituido pelo formulário
                echo "ID: " . $usuario['id'] . "<br>";
                echo "Nome: " . $usuario['nome'] . "<br>";
                echo "Email: " . $usuario['email'] . "<br>";
                echo "Senha: " . $usuario['senha'] . "<br>";
                echo "Perfil: " . $usuario['perfil'] . "<br>";
            }

            echo "Consulta bem sucedida!";
         }catch(PDOException $e){
            echo "Erro na inserção: ". $e->getMessage();
         }
    }

    public function listar(){

    }
    /**
    *@param array;
    *@return bool;

    */
    public function cadastrar($dados){
        try{
            $query = "INSERT INTO {$this->table}(nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)";

            $stmt = $this->db->prepare($query);


            

        }catch(PDOException $e){
            echo "Erro na preparação da consulta: ". $e->getMessage();
        }
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha', $dados['senha']);
            $stmt->bindParam(':perfil', $dados['perfil']);

        try{
            $stmt->execute();
            echo "Inserção bem-sucedida!";
        }catch(PDOException $e){
            echo "Erro na inserção: ". $e->getMessage();
        }

    }

     /**
    *@param int $id;
    *@param array $dados;
    *@return bool;

    */
    public function editar($id, $dados){

        try{
            $query = "UPDATE {$this->table} SET nome = :nome ,email = :email, senha = :senha, perfil = :perfil WHERE id_usuario = :id";

            $stmt = $this->db->prepare($query);

        }catch(PDOException $e){
            echo "Erro de preparação de consulta: ". $e->getMessage();
        }

            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':senha', $dados['senha']);
            $stmt->bindParam(':perfil', $dados['perfil']);

            try{
                $stmt->execute();
                echo "Seus dados foram atualizados com sucesso!";
            }catch(PDOException $e){
                echo "Erro na inserção: ". $e->getMessage();
            }


    }
    
    public function excluir($id){
        try{

            $query = "DELETE FROM {$this->table} WHERE id_usuario = :id";
            $stmt = $this->db->prepare($query);
        }catch(PDOException $e){
            echo "Erro de preparação de consulta: ". $e->getMessage();
        }

        $stmt -> bindParam(':id', [$id], PDO::PARAM_INT); 

        try{
            $stmt->execute();
            echo "Seus dados foram apagados com sucesso!";
        }catch(PDOException $e){
            echo "Erro na exclusão: ". $e->getMessage();
        }
    }
}