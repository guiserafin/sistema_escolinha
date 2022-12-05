<?php

class CursoModel extends ConnectionController
{

    public object $conn;

    public function listarCurso($turma_id){

        $this->conn = $this->connectDb();

        $sql = "SELECT t.*, `c`.`id` AS id_curso FROM `turma` AS t INNER JOIN `curso` AS c ON (t.`curso_id` = `c`.`id`) WHERE t.`id`='".$turma_id."'";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }
}