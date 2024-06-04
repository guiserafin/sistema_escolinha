<?php
date_default_timezone_set('America/Sao_Paulo');
class NotasModel extends ConnectionController
{
    public object $conn;

    public function listarNotas(){

        $this->conn = $this->connectDb();

        $sql = "SELECT n.*, u.`nome` AS nome_usuario, a.`nome`AS nome_avaliacao FROM `nota` AS n INNER JOIN `usuario` AS u ON (`n`.`aluno_id` = `u`.`id`) INNER JOIN `avaliacao` AS a ON (`n`.`avaliacao_id` = `a`.`id`) ORDER BY nome_usuario";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $dados_notas = $sql_query->fetchAll();

        return $dados_notas;

    }

    public function listarUmaNota($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT n.*, u.`nome` AS nome_usuario, a.`nome`AS nome_avaliacao FROM `nota` AS n INNER JOIN `usuario` AS u ON (`n`.`aluno_id` = `u`.`id`) INNER JOIN `avaliacao` AS a ON (`n`.`avaliacao_id` = `a`.`id`) WHERE n.`id`=" .$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados= $sql_query->fetchAll()[0];

        return $sql_dados;

    }

    public function cadastrarNota($dados){

        $this->conn = $this->connectDb();

        var_dump($dados);

        $sql = "INSERT INTO `nota` (`aluno_id`, `avaliacao_id`, `nota`) 
            VALUES ('".$dados['id_aluno']."', '".$dados['id_avaliacao']."', '".$dados['nota']."')";
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = '<p>Nota cadastrada com sucesso!</p>';
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";      
        }
    }

    public function editarNota($dados){

        $this->conn = $this->connectDb();
        // var_dump($dados);

        $sql = "UPDATE `nota` SET `avaliacao_id` = '".$dados['id_avaliacao']."', `nota` = '".$dados['nota']."' WHERE `nota`.`id` = ".$dados['id_nota'];
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";
        }

    }

    public function deletarNota($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `nota` WHERE `nota`.`id`= " . $id;
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Nota excluída com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";
        }

    }
}