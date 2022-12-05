<?php
date_default_timezone_set('America/Sao_Paulo');
class HistoricoModel extends ConnectionController
{
    public object $conn;

    public function criarHistorico($curso_id,$nome_disciplina){

        $this->conn = $this->connectDb();

        $sql_disciplina = "SELECT `id` FROM `disciplinas` WHERE `disciplinas`.`nome`='".$nome_disciplina."'";
        $sql_disciplina_query = $this->conn->prepare($sql_disciplina);
        $sql_disciplina_query->execute();
        $sql_disciplina_dados = $sql_disciplina_query->fetchAll();


        $disciplina_id = $sql_disciplina_dados[0]['id'];
        

        $sql_historico = "INSERT INTO `historico` (`id`, `curso_id`, `disciplina_id`) VALUES (NULL, '".$curso_id."', '".$disciplina_id."')";
        $sql_historico_query = $this->conn->prepare($sql_historico);

        if($sql_historico_query->execute()){
            $_SESSION['msg'] = "<p>Disciplina adicionada</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro</p>";
        }
    }

    public function deletarHistorico($curso_id, $disciplina_id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `historico` WHERE `historico`.`curso_id`='".$curso_id."' AND `historico`.`disciplina_id`='".$disciplina_id."'";
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Removida com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro</p>";
        }
    }
}