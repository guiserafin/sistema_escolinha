<?php
// session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{

    if($_POST){
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
        <link rel="shortcut icon" href="../assets/images/2.png" type="image/x-icon">
    </head>
    <body>
            <div class="voltar">
                <a class="link" href="<?php echo DOMINIO_ADM . "/dashboard" ?>">Voltar</a>
            </div>
            <?php
                if(isset($_SESSION['msg'])){
                    ?>
                    <div class="criado">              
                    <p><?=$_SESSION['msg']?></p>
                    </div>
                    <?php
                    unset($_SESSION['msg']);
                } 
            ?>
            <div class="dados-cadastro d-flex">
                <div id="dados-pessoais" class="conteudo-cadastro-dados-pessoais">
                    <div class="inputs-cadastro-dados-pessoais">
                        <form action="<?php echo DOMINIO_ADM . "/usuarios/store" ?>" method="post">
                            <input type="hidden" name="id">
                            <input type="hidden" name="tipo" value="2">
                            <div>
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" maxlength="200" required>
                            </div>
                            <div>
                                <label for="email">Email - Será o login</label>
                                <input  type="email" name="email" id="email" maxlength="200" required>
                            </div>
                            <div>
                                <label for="senha">Senha</label>
                                <input  type="password" name="senha" id="senha" maxlength="20" required>
                            </div>
                            <div>
                                <label for="telefone">Telefone</label>
                                <input  type="text" name="telefone" id="telefone" maxlength="20" required>
                            </div>
                            <div>
                                <label for="nascimento">Data de nascimento</label>
                                <input  type="date" name="nascimento" id="nascimento" required>
                            </div>
                            <div>
                                <label for="cpf">CPF</label>
                                <input  type="text" name="cpf" id="cpf" maxlength="14" required>
                            </div>
                            <div>
                                <label for="rg">RG</label>
                                <input  type="text" name="rg" id="rg" maxlength="20" required>
                            </div>
                            <div>
                                <label for="">Turma</label>
                                <select name="turma" id="turma">
                                    <?php
                                        foreach($turmas->list() as $key => $turma){
                                            ?>
                                                <option value="<?= $turma['id'] ?>">
                                                    <?php echo $turma['nome'] ?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div> 
                                <label for="cep">CEP</label>
                                <input  type="text" name="cep" id="cep" maxlength="9" required>
                            </div>
                                <button id="enviar" type="Submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div><!--fim dados pessoais-->
            </div>
    </body>
    </html>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script>
        $("#cpf").mask('000.000.000-00');
        $("#telefone").mask("(00)00000-0000");
    </script>
    <?php
}