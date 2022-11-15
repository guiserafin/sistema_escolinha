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

        $sql = "SELECT u.*, t.`nome` AS nome_turma, e.* FROM `usuarios` AS u
        INNER JOIN `turma` AS t ON (u.`turma_id` = t.`id`)
        INNER JOIN `endereco` as e ON (u.`endereco_id` = e.`id`)
        WHERE u.`nivelAcesso_id` = 2;"; //nivel acesso 2 = professores
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarUserUnico($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, e.*, t.`nome` as nome_turma FROM `usuarios` AS u INNER JOIN `endereco` as e ON (u.`endereco_id` = e.`id`) INNER JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`id` = $id";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];

    }

    public function editarDadosAluno($dados){

        
        $this->conn = $this->connectDb();

        $data = date("Y-m-d H:i:s");

        $sql = "UPDATE `usuarios` SET `nome`='" . $dados['nome'] . "',`idade`='" . $dados['idade'] . "',`dataNascimento`='" . $dados['nascimento'] . "',`email`='" . $dados['email'] . "',`cpf`='" . $dados['cpf'] . "',`rg`='" . $dados['rg'] . "',`sexo`='" . $dados['sexo'] . "',`telefone`='" . $dados['telefone'] . "',`matricula`='" . $dados['matricula'] . "',`dateModified`='$data' WHERE `id` = " . $dados['id'];
        
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Edição não realizada</p>";
        }

    }




    public function excluirUsuario($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM usuarios WHERE `usuarios`.`id` = $id";

        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Usuário excluído com sucesso</p>";
            $_SESSION['hide'] = "";
        }else{
            $_SESSION['msg'] = "<p style =''>Usuário não excluído</p>";
        }

    }

}

//INSERT INTO `usuarios` (`id`, `nome`, `idade`, `dataNascimento`, `email`, `senha`, `cpf`, `rg`, `sexo`, `telefone`, `matricula`, `situacao_id`, `nivelAcesso_id`, `endereco_id`, `turma_id`, `dateCreate`, `dateModified`) VALUES (NULL, 'Arthur Felipe Fábio Rocha', '25', '1997-05-22', '', 'arthurfeliperocha@grupoitaipu.com.br', '803.537.471-06', '2.844.229', 'masculino', '(83) 99731-5607', '2022-5607', '1', '3', '1', '1', '2022-11-09 17:31:19.000000', NULL);