<?php
date_default_timezone_set('America/Sao_Paulo');
class DisciplinasModel extends ConnectionController
{

    public object $conn;

    public function listarDisciplinas(){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `disciplina`";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarUmaDisciplina($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `disciplina` WHERE `disciplina`.`id`=" .$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function criarDisciplina($nome){

        $this->conn = $this->connectDb();
        
        $sql = "INSERT INTO `disciplina` (`nome`) VALUES ('".$nome."')";
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Disciplina criada com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível criar a disciplina</p>";
        }
        
    }

    public function editarDisciplina($nome, $id){
        
        $this->conn = $this->connectDb();

        $dateModified = date("Y-m-d H:i:s");

        $sql = "UPDATE `disciplina` SET `nome` = '".$nome."', `dateModified` = '".$dateModified."' WHERE `disciplina`.`id` =".$id;
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Ediçao realizada com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível realizar a edição</p>";
        }

    }

    public function excluirDisciplina($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `historico` WHERE `historico`.`disciplina_id`=". $id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();

        $sql_disciplina = "DELETE FROM `disciplina` WHERE `disciplina`.`id`=". $id;
        $sql_disciplina_query = $this->conn->prepare($sql_disciplina);
        

        if($sql_disciplina_query->execute()){
            $_SESSION['msg'] = "<p>Disciplina excluída com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível excluir</p>";
        }

    }

}