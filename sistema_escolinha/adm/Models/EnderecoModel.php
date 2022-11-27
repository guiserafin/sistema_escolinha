<?php
session_start();

class EnderecoModel extends ConnectionController
{

    public object $conn;

    public function listarEnderecoUnico($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `endereco` WHERE `id` = $id";
        $sql_query = $this->conn->prepare($sql);
        
        $sql_query->execute();

        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];

    }

    public function editarDadosEndereco($dados){

        $this->conn = $this->connectDb();


        $data = date("Y-m-d H:i:s");

        $sql = " UPDATE `endereco` SET `cep`='" . $dados['cep'] . "',`uf`='" . $dados['uf'] . "',`cidade`='" . $dados['cidade'] . "',`bairro`='" . $dados['bairro'] . "',`logradouro`='" . $dados['logradouro'] . "',`numero`='" . $dados['numero'] . "',`complemento`='" . $dados['complemento'] . "' WHERE `id` = " . $dados['endereco_id'];

        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p style =''>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Edição não realizada</p>";
        }
    }

    public function listarEnderecos(){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `endereco`";
        $sql_query = $this->conn->prepare($sql);
        
        $sql_query->execute();

        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;
    }

    public function excluirEndereco($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM endereco WHERE `endereco`.`id` =" .$id;
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Exclusão realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Endereço pertence a um usuário</p>";
        }

    }

}