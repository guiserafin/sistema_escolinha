<?php
session_start();

class UsuarioModel extends ConnectionController
{
    public object $conn;

    function logar($email, $senha){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuarios` WHERE `email` = '$email' AND `senha` = md5('$senha') AND `situacao_id` = 1 LIMIT 1";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        $_SESSION['id']             = $sql_dados[0]['id'];
        $_SESSION['nome']           = $sql_dados[0]['nome'];
        $_SESSION['cpf']            = $sql_dados[0]['cpf'];
        $_SESSION['nivelAcesso_id'] = $sql_dados[0]['nivelAcesso_id'];
        $_SESSION['situacao_id']    = $sql_dados[0]['situacao_id'];
        $_SESSION['turma_id']       = $sql_dados[0]['turma_id'];


        $rowCount = count($sql_dados);

        return $rowCount;

    }

    public function listarProfessores($turma_id){
        
        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuarios` AS u INNER JOIN `turma` as t ON (u.`turma_id` = t.`id`) WHERE u.`nivelAcesso_id` = '2' AND u.`turma_id`= '". $turma_id."'";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();
        return $sql_dados;

    }

    public function listarAlunos($turma_id){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` AS nome_turma, e.* FROM `usuarios` AS u INNER JOIN `turma` as t ON (u.`turma_id` = t.`id`) INNER JOIN `endereco` AS e ON (u.`endereco_id` = e.`id`) WHERE u.`nivelAcesso_id` = '3' AND u.`turma_id`= '". $turma_id."'";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listUmAluno($id){


        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, e.* FROM `usuarios` AS u INNER JOIN `endereco` AS e ON (u.`endereco_id` = e.`id`) WHERE u.`id`=".$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function editarUsuario($dados){

        $this->conn = $this->connectDb();

        $data = date("Y-m-d H:i:s");

        if($dados['senha'] == ""){
            $sql = "UPDATE `usuarios` SET `nome`='" . $dados['nome'] . "',`idade`='" . $dados['idade'] . "',`dataNascimento`='" . $dados['nascimento'] . "',`email`='" . $dados['email'] . "',`cpf`='" . $dados['cpf'] . "',`rg`='" . $dados['rg'] . "',`sexo`='" . $dados['sexo'] . "',`telefone`='" . $dados['telefone'] . "',`matricula`='" . $dados['matricula'] . "',`dateModified`='$data' WHERE `id` = " . $dados['id'];
        }else{
            $sql = "UPDATE `usuarios` SET `nome`='" . $dados['nome'] . "',`idade`='" . $dados['idade'] . "',`senha` = '".md5($dados['senha'])."',`dataNascimento`='" . $dados['nascimento'] . "',`email`='" . $dados['email'] . "',`cpf`='" . $dados['cpf'] . "',`rg`='" . $dados['rg'] . "',`sexo`='" . $dados['sexo'] . "',`telefone`='" . $dados['telefone'] . "',`matricula`='" . $dados['matricula'] . "',`dateModified`='$data' WHERE `id` = " . $dados['id'];
        }
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Edição não realizada</p>";
        }
    }

}