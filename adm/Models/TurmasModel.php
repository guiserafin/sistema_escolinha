<?php
date_default_timezone_set('America/Sao_Paulo');
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

    public function criarTurma($dados){

        $this->conn = $this->connectDb();

        $curso_id = $dados['curso'];


        $sql_turma = "INSERT INTO `turma` (`id`, `nome`, `curso_id`) VALUES (NULL,'".$dados['nome']."','".$curso_id."')";
        $sql_turma_query = $this->conn->prepare($sql_turma);

        if($sql_turma_query->execute()){
            $_SESSION['msg'] = "<p>Turma cadastrada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível cadastrar a turma</p>";
        }


    }

    public function editarTurma($id_turma, $curso_id, $nome_turma){

        $this->conn = $this->connectDb();

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