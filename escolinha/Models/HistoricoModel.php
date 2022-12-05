<?php

class HistoricoModel extends ConnectionController
{

    public object $conn;

    public function listarHistorico($id_curso){

        $this->conn = $this->connectDb();

        $sql = "SELECT h.*, c.`nome` AS nome_curso, `d`.`nome` AS nome_disciplina FROM `historico` AS h INNER JOIN `curso` AS c ON (`h`.`curso_id` = `c`.`id`) INNER JOIN `disciplinas` AS d ON (`h`.`disciplina_id` = `d`.`id`) WHERE h.`curso_id`='".$id_curso."'";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $dados_sql = $sql_query->fetchAll();

        return $dados_sql;

    }

}