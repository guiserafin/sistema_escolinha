<?php

class NotasModel extends ConnectionController
{
    public object $conn;

    public function listarNotas($aluno_id){

        $this->conn = $this->connectDb();

        $sql = "SELECT n.*, `a`.`nome` AS nome_avaliacao FROM `notas` AS n INNER JOIN `avaliacoes` AS a ON (`n`.`avaliacao_id` = `a`.`id`) WHERE n.`usuario_id` =". $aluno_id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }
}