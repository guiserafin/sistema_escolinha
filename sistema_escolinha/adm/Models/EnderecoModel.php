<?php
session_start();

class EnderecoModel extends ConnectionController
{

    public object $conn;

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

}