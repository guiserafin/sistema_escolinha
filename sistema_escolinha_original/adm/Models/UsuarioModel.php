<?php
session_start();
class UsuarioModel extends ConnectionController
{
    public object $conn;

    function logar($email, $senha){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuarios` WHERE `email` = '$email' AND `senha` = md5('$senha') AND `situacao_id` = 1 AND `nivelAcesso_id` IN (1,2,4) LIMIT 1";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        $_SESSION['id']             = $sql_dados[0]['id'];
        $_SESSION['nome']           = $sql_dados[0]['nome'];
        $_SESSION['cpf']            = $sql_dados[0]['cpf'];
        $_SESSION['nivelAcesso_id'] = $sql_dados[0]['nivelAcesso_id'];
        $_SESSION['situacao_id']    = $sql_dados[0]['situacao_id'];

        $rowCount = count($sql_dados);

        return $rowCount;

    }


    public function listarAlunos(){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuarios` WHERE `nivelAcesso_id` = 3 ORDER BY `nome`"; //nivel acesso 3 = alunos
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarProfessores(){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, e.* FROM `usuarios` AS u INNER JOIN `endereco` as e ON (u.`endereco_id` = e.`id`) WHERE `nivelAcesso_id` = 2"; //nivel acesso 2 = professores
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarAlunoUnico($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, e.* FROM `usuarios` AS u INNER JOIN `endereco` as e ON (u.`endereco_id` = e.`id`) WHERE u.`id` = $id"; //nivel acesso 3 = alunos
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];

    }
}

//INSERT INTO `usuarios` (`id`, `nome`, `idade`, `dataNascimento`, `email`, `senha`, `cpf`, `rg`, `sexo`, `telefone`, `matricula`, `situacao_id`, `nivelAcesso_id`, `endereco_id`, `turma_id`, `dateCreate`, `dateModified`) VALUES (NULL, 'Arthur Felipe Fábio Rocha', '25', '1997-05-22', '', 'arthurfeliperocha@grupoitaipu.com.br', '803.537.471-06', '2.844.229', 'masculino', '(83) 99731-5607', '2022-5607', '1', '3', '1', '1', '2022-11-09 17:31:19.000000', NULL);