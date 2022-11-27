<?php

class TurmasModel extends ConnectionController
{

    public object $conn;

    public function listarTurmas(){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `turma`";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarTurmaUnica($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `turma` WHERE `id`=" . $id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function deletarTurma($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `turma` WHERE `turma`.`id`=" . $id;
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Turma excluída com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível excluir a turma</p>";
        }
    }

    public function criarTurma($nome_turma,$nome_curso){

        $this->conn = $this->connectDb();

        $sql_curso = "SELECT `id` FROM `curso` WHERE `curso`.`nome`='" .$nome_curso."'";
        $sql_curso_query = $this->conn->prepare($sql_curso);
        $sql_curso_query->execute();
        $sql_curso_dados = $sql_curso_query->fetchAll();

        $curso_id = $sql_curso_dados[0]['id'];
        $dateCreate = date("Y-m-d H:i:s");


        $sql_turma = "INSERT INTO `turma` (`id`, `nome`, `curso_id`, `dateCreate`, `dateModified`) VALUES (NULL,'".$nome_turma."','".$curso_id."','".$dateCreate."', NULL)";
        $sql_turma_query = $this->conn->prepare($sql_turma);

        if($sql_turma_query->execute()){
            $_SESSION['msg'] = "<p>Turma cadastrada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível cadastrar a turma</p>";
        }


    }

    public function editarTurma($id_turma, $nome_curso,$nome_turma){

        $this->conn = $this->connectDb();

        
        $sql_curso = "SELECT `id` FROM `curso` WHERE `curso`.`nome`='" .$nome_curso."'";
        $sql_curso_query = $this->conn->prepare($sql_curso);
        $sql_curso_query->execute();
        $sql_curso_dados = $sql_curso_query->fetchAll();

        $curso_id = $sql_curso_dados[0]['id'];

        $dateModified = date("Y-m-d H:i:s");

        $sql_turma = "UPDATE `turma` SET `nome` = '".$nome_turma."', `curso_id` = '".$curso_id."', `dateModified` = '".$dateModified."' WHERE `turma`.`id` =".$id_turma;
        $sql_turma_query = $this->conn->prepare($sql_turma);
        if($sql_turma_query->execute()){
            $_SESSION['msg'] = "<p>Turma editada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível editar a turma</p>";
        }

    }

}