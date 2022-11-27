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

        $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuarios` AS u
        LEFT JOIN `turma` AS t ON (u.`turma_id` = t.`id`)
        WHERE u.`nivelAcesso_id` = 2;"; //nivel acesso 2 = professores
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados;

    }

    public function cadastrarProfessor($dados){

        $anoAtual   = date("Y");
        $mesAtual   = date("m");
        $diaAtual   = date("d");
        
        $data_user = $dados['nascimento'];
        $arr_data_user = explode("-", $data_user);
        // var_dump($arr_data_user); //0-ano, 1-mes, 2-dia
        
        $anoNasc = $arr_data_user[0];
        $mesNasc = $arr_data_user[1];
        $diaNasc = $arr_data_user[2];
        $idade = $anoAtual - $anoNasc;
        
        if ($mesAtual < $mesNasc){
            $idade -= 1;
        }elseif( ($mesAtual == $mesNasc) && ($diaAtual < $diaNasc) ){
            $idade -= 1;
        }
        $arr_telefone = explode("-", $dados['telefone']);
        
        $matricula = $anoAtual . "-" . $arr_telefone[1];
        
        $situacao_id = '1';
        $nivelAcesso_id = '2';
        $dateCreate = date("Y-m-d H:i:s");

        $this->conn = $this->connectDb();
        $sql_teste = "SELECT * FROM `usuarios` WHERE `email` = '".$dados['email']."'";
        $sql_teste_query = $this->conn->prepare($sql_teste);
        $sql_teste_query->execute();
        $sql_teste_dados = $sql_teste_query->fetchAll();
        $rowCount = count($sql_teste_dados);
    

        if($rowCount>0){
            $_SESION['msg'] = "Email já utilizado - tente outro"; //Esta lógica funcionou, porem o usuario sem ter endereco cadastrado esta dando problema na hora de excluir e editar
        }else{

            
            $sql_endereco_consultar = "SELECT `id` FROM `endereco` WHERE `cep` = '".$dados['cep']."' LIMIT 1";
            $sql_endereco_consultar_query = $this->conn->prepare($sql_endereco_consultar);
            $sql_endereco_consultar_query->execute();
            $sql_endereco_consultar_dados = $sql_endereco_consultar_query->fetchAll();
            
            
            
            if(sizeof($sql_endereco_consultar_dados) == 0){
                $sql_endereco = "INSERT INTO `endereco` (`id`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES (NULL,'".$dados['cep']."','".$dados['uf']."','".$dados['cidade']."','".$dados['bairro']."','".$dados['logradouro']."','".$dados['numero']."','".$dados['complemento']."')";
                $sql_endereco_query = $this->conn->prepare($sql_endereco);
                $sql_endereco_query->execute();
            }
            
            $sql_endereco_consultar2 = "SELECT `id` FROM `endereco` WHERE `cep` = '".$dados['cep']."' LIMIT 1";
            $sql_endereco_consultar_query2 = $this->conn->prepare($sql_endereco_consultar2);
            $sql_endereco_consultar_query2->execute();
            $sql_endereco_consultar_dados2 = $sql_endereco_consultar_query2->fetchAll();
            $id_endereco = $sql_endereco_consultar_dados2[0][0];
            
            $sql_turma = "SELECT `id` FROM `turma` WHERE `nome` = '" . $dados['turma'] . "'";
            $sql_turma_query = $this->conn->prepare($sql_turma);
            $sql_turma_query->execute();
            $sql_turma_dados = $sql_turma_query->fetchAll();

            $id_turma = $sql_turma_dados[0][0];




            $sql = "INSERT INTO `usuarios` (`id`, `nome`, `idade`, `dataNascimento`, `email`, `senha`, `cpf`, `rg`, `sexo`, `telefone`, `matricula`,`situacao_id`, `nivelAcesso_id`, `endereco_id`, `turma_id`, `dateCreate`, `dateModified`) VALUES (NULL,'".$dados['nome']."','".$idade."','".$dados['nascimento']."','".$dados['email']."','".MD5($dados['senha'])."','".$dados['cpf']."','".$dados['rg']."','".$dados['sexo']."','".$dados['telefone']."','".$matricula."','".$situacao_id."','".$nivelAcesso_id."','".$id_endereco."','".$id_turma."','".$dateCreate."',NULL)";
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

        $sql = "SELECT u.*, e.*, t.`nome` as nome_turma FROM `usuarios` AS u LEFT JOIN `endereco` as e ON (u.`endereco_id` = e.`id`) RIGHT JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`id` = $id";
        // $sql = "SELECT u.*, t.`nome` AS nome_turma FROM `usuarios` AS u LEFT JOIN `turma` AS t ON (u.`turma_id` = t.`id`) WHERE u.`id` = $id";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];

    }

    public function listarUserExcluir($id){

        $this->conn = $this->connectDb();

        $sql = "SELECT * FROM `usuarios` WHERE `id` = $id";
        $sql_query = $this->conn->prepare($sql);
        $sql_query->execute();
        $sql_dados = $sql_query->fetchAll();

        return $sql_dados[0];
    }

    public function editarDadosUser($dados){

        
        
        $this->conn = $this->connectDb();

        $data = date("Y-m-d H:i:s");

        $sql_turma = "SELECT `id` FROM `turma` WHERE `turma`.`nome`='" . $dados['nome_turma'] . "'";
        $sql_turma_query = $this->conn->prepare($sql_turma);
        $sql_turma_query->execute();
        $dados_turma = $sql_turma_query->fetchAll()[0];

        $turma_id = $dados_turma['id']; 

        $sql = "UPDATE `usuarios` SET `nome`='" . $dados['nome'] . "',`idade`='" . $dados['idade'] . "',`dataNascimento`='" . $dados['nascimento'] . "',`email`='" . $dados['email'] . "',`cpf`='" . $dados['cpf'] . "',`rg`='" . $dados['rg'] . "',`sexo`='" . $dados['sexo'] . "',`telefone`='" . $dados['telefone'] . "',`matricula`='" . $dados['matricula'] . "',`dateModified`='$data', `turma_id`='".$turma_id."' WHERE `id` = " . $dados['id'];
        $sql_query = $this->conn->prepare($sql);
        
        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Edição realizada com sucesso</p>";
        }else{
            $_SESSION['msg'] = "<p style =''>Edição não realizada</p>";
        }

    }



    public function excluirUsuario($id){


        $this->conn = $this->connectDb();

        $sql = "DELETE FROM `usuarios` WHERE `id` = $id";

        $sql_query = $this->conn->prepare($sql);

        if($sql_query->execute()){
            $_SESSION['msg'] = "<p>Usuário excluído com sucesso</p>";
            $_SESSION['hide'] = "";
        }else{
            $_SESSION['msg'] = "<p style =''>Usuário não excluído</p>";
        }

    }

    public function cadastrarAluno($dados){

        
        $anoAtual   = date("Y");
        $mesAtual   = date("m");
        $diaAtual   = date("d");
        
        $data_user = $dados['nascimento'];
        $arr_data_user = explode("-", $data_user);
        // var_dump($arr_data_user); //0-ano, 1-mes, 2-dia
        
        $anoNasc = $arr_data_user[0];
        $mesNasc = $arr_data_user[1];
        $diaNasc = $arr_data_user[2];
        $idade = $anoAtual - $anoNasc;
        
        if ($mesAtual < $mesNasc){
            $idade -= 1;
        }elseif( ($mesAtual == $mesNasc) && ($diaAtual < $diaNasc) ){
            $idade -= 1;
        }
        $arr_telefone = explode("-", $dados['telefone']);
        
        $matricula = $anoAtual . "-" . $arr_telefone[1];
        
        $situacao_id = '1';
        $nivelAcesso_id = '3';
        $dateCreate = date("Y-m-d H:i:s");

        $this->conn = $this->connectDb();
        $sql_teste = "SELECT * FROM `usuarios` WHERE `email` = '".$dados['email']."'";
        $sql_teste_query = $this->conn->prepare($sql_teste);
        $sql_teste_query->execute();
        $sql_teste_dados = $sql_teste_query->fetchAll();
        $rowCount = count($sql_teste_dados);
    

        if($rowCount>0){
            $_SESION['msg'] = "Email já utilizado - tente outro";
        }else{


            $sql_endereco_consultar = "SELECT `id` FROM `endereco` WHERE `cep` = '".$dados['cep']."' LIMIT 1";
            $sql_endereco_consultar_query = $this->conn->prepare($sql_endereco_consultar);
            $sql_endereco_consultar_query->execute();
            $sql_endereco_consultar_dados = $sql_endereco_consultar_query->fetchAll();
            
            
            
            if(sizeof($sql_endereco_consultar_dados) == 0){
                $sql_endereco = "INSERT INTO `endereco` (`id`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES (NULL,'".$dados['cep']."','".$dados['uf']."','".$dados['cidade']."','".$dados['bairro']."','".$dados['logradouro']."','".$dados['numero']."','".$dados['complemento']."')";
                $sql_endereco_query = $this->conn->prepare($sql_endereco);
                $sql_endereco_query->execute();
            }
            
            $sql_endereco_consultar2 = "SELECT `id` FROM `endereco` WHERE `cep` = '".$dados['cep']."' LIMIT 1";
            $sql_endereco_consultar_query2 = $this->conn->prepare($sql_endereco_consultar2);
            $sql_endereco_consultar_query2->execute();
            $sql_endereco_consultar_dados2 = $sql_endereco_consultar_query2->fetchAll();
            $id_endereco = $sql_endereco_consultar_dados2[0][0];


            $sql_turma = "SELECT `id` FROM `turma` WHERE `nome` = '" . $dados['turma'] . "'";
            $sql_turma_query = $this->conn->prepare($sql_turma);
            $sql_turma_query->execute();
            $sql_turma_dados = $sql_turma_query->fetchAll();

            $id_turma = $sql_turma_dados[0][0];




            $sql = "INSERT INTO `usuarios` (`id`, `nome`, `idade`, `dataNascimento`, `email`, `senha`, `cpf`, `rg`, `sexo`, `telefone`, `matricula`,`situacao_id`, `nivelAcesso_id`, `endereco_id`, `turma_id`, `dateCreate`, `dateModified`) VALUES (NULL,'".$dados['nome']."','".$idade."','".$dados['nascimento']."','".$dados['email']."','".MD5($dados['senha'])."','".$dados['cpf']."','".$dados['rg']."','".$dados['sexo']."','".$dados['telefone']."','".$matricula."','".$situacao_id."','".$nivelAcesso_id."','".$id_endereco."','".$id_turma."','".$dateCreate."',NULL)";
            $sql_query = $this->conn->prepare($sql);
            if($sql_query->execute()){
                $_SESSION['msg'] = "Cadastrado com sucesso";
            }else{
                $_SESSION['msg'] = "Não cadastrado";
            }
        }
        
    }

}

//INSERT INTO `usuarios` (`id`, `nome`, `idade`, `dataNascimento`, `email`, `senha`, `cpf`, `rg`, `sexo`, `telefone`, `matricula`, `situacao_id`, `nivelAcesso_id`, `endereco_id`, `turma_id`, `dateCreate`, `dateModified`) VALUES (NULL, 'Arthur Felipe Fábio Rocha', '25', '1997-05-22', '', 'arthurfeliperocha@grupoitaipu.com.br', '803.537.471-06', '2.844.229', 'masculino', '(83) 99731-5607', '2022-5607', '1', '3', '1', '1', '2022-11-09 17:31:19.000000', NULL);