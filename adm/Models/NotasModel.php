<?php
date_default_timezone_set('America/Sao_Paulo');
class NotasModel extends ConnectionController
{
    public object $conn;

    public function listarNotas(){

        $this->conn = $this->connectDb();

        $sql = "SELECT n.*, u.`nome` AS nome_usuario, a.`nome`AS nome_avaliacao FROM `notas` AS n INNER JOIN `usuarios` AS u ON (`n`.`usuario_id` = `u`.`id`) INNER JOIN `avaliacoes` AS a ON (`n`.`avaliacao_id` = `a`.`id`) ORDER BY nome_usuario";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $dados_notas = $sql_query->fetchAll();

        return $dados_notas;

    }

    public function listarUmaNota($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT n.*, u.`nome` AS nome_usuario, a.`nome`AS nome_avaliacao FROM `notas` AS n INNER JOIN `usuarios` AS u ON (`n`.`usuario_id` = `u`.`id`) INNER JOIN `avaliacoes` AS a ON (`n`.`avaliacao_id` = `a`.`id`) WHERE n.`id`=" .$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados= $sql_query->fetchAll()[0];

        return $sql_dados;

    }

    public function cadastrarNota($dados){

        $this->conn = $this->connectDb();

        $dateCreate = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `notas` (`id`, `usuario_id`, `avaliacao_id`, `nota`, `dateCreate`) VALUES (NULL, '".$dados['id_aluno']."', '".$dados['id_avaliacao']."', '".$dados['nota']."','".$dateCreate."')";
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = '<p>Nota cadastrada com sucesso!</p>';
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";      
        }
    }

    public function editarNota($dados){

        $this->conn = $this->connectDb();
        $dateModified = date("Y-m-d H:i:s");

        $sql = "UPDATE `notas` SET `avaliacao_id` = '".$dados['id_avaliacao']."', `nota` = '".$dados['nota']."', `dateModified` = '".$dateModified."' WHERE `notas`.`id` = ".$dados['id_nota'];
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";
        }

    }

    public function deletarNota($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `notas` WHERE `notas`.`id`= " . $id;
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Nota excluída com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro.</p>";
        }

    }
}