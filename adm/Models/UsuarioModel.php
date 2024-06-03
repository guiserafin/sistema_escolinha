<?php
date_default_timezone_set('America/Sao_Paulo');
class UsuarioModel extends ConnectionController
{
    public object $conn;

    function logar($email, $senha){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuario` WHERE `email` = '$email' AND `senha` = md5('$senha') AND `situacao_id` = 1 AND `nivelAcesso_id` IN (1,2,4) LIMIT 1";
        $sql_query = $this->conn->prepare($sql);

        if($_SESSION['nome'] == ""){
            
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

    }

    public function list($prTipo){
        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuario` AS u 
            INNER JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`nivelAcesso_id` = " . $prTipo . " ORDER BY u.`nome`"; //nivel acesso 3 = alunos
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;
    }

    public function listarAlunos(){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuario` AS u 
            INNER JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`nivelAcesso_id` = 2 ORDER BY u.`nome`"; //nivel acesso 3 = alunos
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function listarProfessores(){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuario` AS u
        LEFT JOIN `turma` AS t ON (u.`turma_id` = t.`id`)
        WHERE u.`nivelAcesso_id` = 1;"; //nivel acesso 2 = professores
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function cadastrarProfessor($dados){

        $situacao_id = '1';
        $nivelAcesso_id = '3';

        $this->conn = $this->connectDb();
        $sql_teste = "SELECT * FROM `usuario` WHERE `email` = '".$dados['email']."'";
        $sql_teste_query = $this->conn->prepare($sql_teste);
        $sql_teste_query->execute();
        $sql_teste_dados = $sql_teste_query->fetchAll();
        $rowCount = count($sql_teste_dados);

        if($rowCount>0){
            $_SESION['msg'] = "Email já utilizado - tente outro";
        }else{

            $sql_turma = "SELECT `id` FROM `turma` WHERE `nome` = '" . $dados['turma'] . "'";
            $sql_turma_query = $this->conn->prepare($sql_turma);
            $sql_turma_query->execute();
            $sql_turma_dados = $sql_turma_query->fetchAll();

            $turma_id = $sql_turma_dados[0][0];

            $sql = "INSERT INTO `usuario` (`nome`, `nivelAcesso_id`, `situacao_id`, `turma_id`, `email`, `endereco`, `cpf`, `dataNascimento`, `rg`, `telefone`, `senha`) 
                VALUES ('".$dados['nome']."','".$nivelAcesso_id."','".$situacao_id."','".$turma_id."','".$dados['email']."','".$dados['cep']."','".$dados['cpf']."','".$dados['nascimento']."','".$dados['rg']."','".$dados['telefone']."','". md5($dados['senha']) ."' )";

            $sql_query = $this->conn->prepare($sql);

            if($sql_query->execute()){
                $_SESSION['msg'] = "Cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Não cadastrado";
            }
        }

    }


    public function listarUserUnico($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT u.*, t.`nome` as nome_turma FROM `usuario` AS u
                INNER JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`id` = $id";

        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];

    }

    public function listarUserExcluir($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuario` WHERE `id` = $id";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];
    }

    public function editarDadosUser($dados){

        $this->conn = $this->connectDb();

        $data = date("Y-m-d H:i:s");

        $turma_id = $dados['nome_turma']; 

        $sql = "UPDATE `usuario` SET `nome`='" . $dados['nome'] . "',`dataNascimento`='" . $dados['nascimento'] . "',`email`='" . $dados['email'] . "',`cpf`='" . $dados['cpf'] . "',`rg`='" . $dados['rg'] . "',`endereco`='" . $dados['endereco'] . "',`telefone`='" . $dados['telefone'] . "',`matricula`='" . $dados['matricula'] . "',`dateModified`='$data', `turma_id`='".$turma_id."' WHERE `id` = " . $dados['id'];
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Edição não realizada</p>";
        }

        return;

    }



    public function excluirUsuario($id){

        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `usuario` WHERE `id` = $id";

        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Usuário excluído com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Usuário não excluído</p>";
        }

        return;

    }

    public function cadastrarAluno($dados){

        $arr_telefone = explode("-", $dados['telefone']);
        $matricula    = date('Y') . "-" . $arr_telefone[1];
        
        $situacao_id = '1';
        $nivelAcesso_id = '2';

        $this->conn = $this->connectDb();
        $sql_teste = "SELECT * FROM `usuario` WHERE `email` = '".$dados['email']."'";
        $sql_teste_query = $this->conn->prepare($sql_teste);
        $sql_teste_query->execute();
        $sql_teste_dados = $sql_teste_query->fetchAll();
        $rowCount = count($sql_teste_dados);
    

        if($rowCount>0){

            $_SESION['msg'] = "Email já utilizado - tente outro";

        } else {

            $turma_id = $dados['turma'];


            $sql = "INSERT INTO `usuario` (`nome`, `nivelAcesso_id`, `situacao_id`, `turma_id`, `email`, `endereco`, `cpf`, `dataNascimento`, `rg`, `telefone`, `matricula`, `senha`) 
                    VALUES ('".$dados['nome']."','".$nivelAcesso_id."','".$situacao_id."','".$turma_id."','".$dados['email']."','".$dados['cep']."','".$dados['cpf']."','".$dados['nascimento']."','".$dados['rg']."','".$dados['telefone']."','".$matricula."','". md5($dados['senha']) ."' )";
            $sql_query = $this->conn->prepare($sql);


            if($sql_query->execute()){
                $_SESSION['msg'] = "Cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Não cadastrado";
            }

        }

    }

}