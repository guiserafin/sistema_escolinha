<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{

    if($_POST){
        // var_dump($_POST);
        $novo_aluno = new UsuariosController();
        $novo_aluno->createAluno($_POST);
    }

    $turmas = new TurmasController();
    $turmas->list();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de aluno</title>
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/style.css"?>">
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/font-awesome.min.css" ?>">
    </head>
    <body>
            <div class="voltar">
                <a class="link" href="<?php echo DOMINIO_ADM . "/dashboard" ?>">Voltar</a>
            </div>
            <div class="dados-cadastro d-flex">
                <div id="dados-pessoais" class="conteudo-cadastro-dados-pessoais">
                    <div class="inputs-cadastro-dados-pessoais">
                        <form action="" method="post">
                            <input type="hidden" name="id">
                            <div>
                                <label for="nome">Nome</label>
                                <input  type="text" name="nome" id="nome">
                            </div>
                            <div>
                                <label for="email">Email - Será o login</label>
                                <input  type="email" name="email" id="email">
                            </div>
                            <div>
                                <label for="matricula">Senha</label>
                                <input  type="password" name="matricula" id="matricula">
                            </div>
                            <div>
                                <label for="telefone">Telefone</label>
                                <input  type="text" name="telefone" id="telefone">
                            </div>
                            <div>
                                <label for="nascimento">Data de nascimento</label>
                                <input  type="date" name="nascimento" id="nascimento">
                            </div>
                            <div>
                                <label for="cpf">CPF</label>
                                <input  type="text" name="cpf" id="cpf" maxlength="14">
                            </div>
                            <div>
                                <label for="rg">RG</label>
                                <input  type="text" name="rg" id="rg">
                            </div>
                            <div>
                                <label for="sexo">Sexo</label>
                                <select name="sexo" id="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Turma</label>
                                <select name="turma" id="turma">
                                    <?php
                                        foreach($turmas->list() as $key => $turma){
                                            ?>
                                                <option value="<?= $turma['nome'] ?>">
                                                    <?php echo $turma['nome'] ?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div> 
                                <label for="cep">CEP</label>
                                <input  type="text" name="cep" id="cep" value="<?= $dados['cep'] ?>">
                            </div>
                            <div>
                                <label for="uf">UF</label>
                                <input  type="text" name="uf" id="uf" value="<?= $dados['uf'] ?>">
                            </div>
                            <div>
                                <label for="cidade">Cidade</label>
                                <input  type="text" name="cidade" id="cidade" value="<?= $dados['cidade'] ?>">
                            </div>
                            <div>
                                <label for="Bairro">Bairro</label>
                                <input  type="text" name="bairro" id="bairro" value="<?= $dados['bairro'] ?>">
                            </div>
                            <div>
                                <label for="logradouro">Logradouro</label>
                                <input  type="text" name="logradouro" id="logradouro" value="<?= $dados['logradouro'] ?>">
                            </div>
                            <div>
                                <label for="numero">Numero</label>
                                <input  type="text" name="numero" id="numero" value="<?= $dados['numero'] ?>">
                            </div>
                            <div>
                                <label for="complemento">Complemento</label>
                                <input  type="text" name="complemento" id="complemento" value="<?= $dados['complemento'] ?>">
                            </div>
                            <div>
                                <div>
                                    <?php
                                        if(isset($_SESSION['msg'])){
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        } 
                                    ?>
                                </div>
                                <button id="enviar" type="Submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div><!--fim dados pessoais-->
            </div>
        
    </body>
    </html>


    <?php
}