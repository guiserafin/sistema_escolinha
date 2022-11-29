<?php

class AvaliacoesModel extends ConnectionController
{
    
    public object $conn;


    public function listarAvaliacoes(){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `avaliacoes`";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

}