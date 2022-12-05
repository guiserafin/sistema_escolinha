<?php

class AvaliacoesModel extends ConnectionController
{
    public object $conn;

    public function listarAvaliacoes($turma_id){

        $this->conn = $this->connectDb();

        $sql = "SELECT a.*, d.`nome` AS nome_disciplina FROM `avaliacoes` AS a INNER JOIN `disciplinas` AS d ON (a.`disciplina_id` = d.`id`) WHERE a.`turma_id`=".$turma_id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }
}