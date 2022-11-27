<?php

class CursosModel extends ConnectionController
{

    public object $conn;

    public function listarCursos(){//listar cursos, e suas disciplinas

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `curso`";

        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();
        
        return $sql_dados;

    }

    public function listCursoUnico($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `curso` WHERE `curso`.`id`=" .$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;
        
    }

    public function listarDisciplinasDoCurso($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT h.*,c.* ,c.`nome` AS nome_curso, d.`nome` AS nome_disciplina, d.`id` AS id_disciplina, c.`id` as curso_id FROM `historico` AS h LEFT JOIN `curso` AS c ON (h.`curso_id` = c.`id`) LEFT JOIN `disciplinas` AS d ON (h.`disciplina_id` = d.`id`) WHERE c.`id` = $id ORDER BY id_disciplina";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }


    public function editarCurso($dados){

        $this->conn = $this->connectDb();

        $sql = "UPDATE `curso` SET `nome` = '".$dados['nome_curso']."', `dataInicio` = '".$dados['dataInicio']."', `dataFim` = '".$dados['dataFim']."' WHERE `curso`.`id` =".$dados['id'];
        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Edição não realizada</p>";
        }


    }

    public function criarCurso($dados){
        
        $dateCreate = date("Y-m-d H:i:s");
        
        $this->conn = $this->connectDb();

        $sql= "INSERT INTO `curso` (`id`, `nome`, `dataInicio`, `dataFim`, `dateCreate`, `dateModified`) VALUES (NULL, '".$dados['nome_curso']."', '".$dados['dataInicio']."', '".$dados['dataFim']."', '".$dateCreate."', NULL)";
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Curso criado com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível criar o curso</p>";
        }
    }

    public function deletarCurso($id){


        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `historico` WHERE `historico`.`curso_id`=" .$id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();

        $sql_curso = "DELETE FROM `curso` WHERE `curso`.`id`=" .$id;
        $sql_curso_query = $this->conn->prepare($sql_curso);
        
        if($sql_curso_query->execute()){
            $_SESSION['msg'] = "<p>Curso excluído com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p>Não foi possível excluir o curso</p>";
        }
        
    }

}