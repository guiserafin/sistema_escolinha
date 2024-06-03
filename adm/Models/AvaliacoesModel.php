<?php
date_default_timezone_set('America/Sao_Paulo');
class AvaliacoesModel extends ConnectionController
{
    
    public object $conn;


    public function listarAvaliacoes(){

        $this->conn = $this->connectDb();

        $sql = "SELECT a.*, d.`nome` AS nome_disciplina, t.`nome` AS nome_turma FROM `avaliacao` AS a 
            INNER JOIN `disciplina` AS d ON (a.`disciplina_id` = d.`id`) 
            INNER JOIN `turma` AS t ON (a.`turma_id` = t.`id`)";

        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarUmaAvaliacao($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `avaliacao` WHERE `avaliacao`.`id`=". $id;
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $dados_avalicao = $sql_query->fetchAll();

        return $dados_avalicao[0];

    }

    public function criarAvaliacao($dados){

        $this->conn = $this->connectDb();
        
        $sql = "INSERT INTO `avaliacao` (`nome`, `disciplina_id`,`turma_id`, `data`) 
                VALUES ('".$dados['nome_avaliacao']."', '".$dados['nome_disciplina']."','".$dados['id_turma']."','".$dados['data']."')";
        $sql_query = $this->conn->prepare($sql);

        try{

            if($sql_query->execute()){
                $_SESSION['msg'] = '<p>Avaliação criada com sucesso!</p>';
            }else{
                $_SESSION['msg'] = "<p>Erro</p>";
            }

        } catch (Exception $e) {
            $_SESSION['msg'] = $e;
        }


    }

    public function editarAvaliacao($dados){

        $this->conn = $this->connectDb();

        
        $sql_disciplina = "SELECT `id` FROM `disciplinas` WHERE `disciplinas`.`nome`='". $dados['nome_disciplina']."'";
        $sql_disciplina_query = $this->conn->prepare($sql_disciplina);
        $sql_disciplina_query->execute();
        $id_disciplina = $sql_disciplina_query->fetchAll()[0]['id'];
        $dateModified = date("Y-m-d H:i:s");
        
        $sql_avaliacao = "UPDATE `avaliacao` SET `nome` = '".$dados['nome_avaliacao']."', `disciplina_id` = '".$id_disciplina."',`turma_id` = '".$dados['id_turma']."', `data` = '".$dados['data']."', `dateModified` = '".$dateModified."' WHERE `avaliacoes`.`id` =" . $dados['id'];
        $sql_avaliacao_query = $this->conn->prepare($sql_avaliacao);

        if($sql_avaliacao_query->execute()){
            $_SESSION['msg'] = '<p>Edição realizada com sucesso!</p>';
        }else{
            $_SESSION['msg'] = "<p>Erro!</p>";
        }

    }

    public function deletarAvaliacao($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `avaliacao` WHERE `avaliacao`.`id`=".$id;
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Excluída com sucesso!</p>";
        }else{
            $_SESSION['msg'] = "<p>Erro - Alunos já realizaram a avaliação.</p>";
        }

    }

}