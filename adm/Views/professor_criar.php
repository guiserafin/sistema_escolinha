<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{

    if($_POST){
        // var_dump($_POST);
        $novo_aluno = new UsuariosController();
        $novo_aluno->createProfessor($_POST);
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
        <title>Cadastro de professor</title>
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/style.css"?>">
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/font-awesome.min.css" ?>">
    </head>
    <body>
            <div class="voltar">
                <a class="link" href="<?php echo DOMINIO_ADM . "/professores" ?>">Voltar</a>
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
                        <form action="" method="post">
                            <input type="hidden" name="id">
                            <div>
                                <label for="nome">Nome</label>
                                <input  type="text" name="nome" id="nome" maxlength="200" required>
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
                                <input  type="text" name="cep" id="cep" maxlength="9" required>
                            </div>
                            <div>
                                <label for="uf">UF</label>
                                <select name="uf" id="uf">
                                    <option value="Acre (AC)">Acre (AC)</option>
                                    <option value="Alagoas (AL)">Alagoas (AL)</option>
                                    <option value="Amapá (AP)">Amapá (AP)</option>
                                    <option value="Amazonas (AM)">Amazonas (AM)</option>
                                    <option value="Bahia (BA)">Bahia (BA)</option>
                                    <option value="Ceará (CE)">Ceará (CE)</option>
                                    <option value="Distrito Federal (DF)">Distrito Federal (DF)</option>
                                    <option value="Espírito Santo (ES)">Espírito Santo (ES)</option>
                                    <option value="Goiás (GO)">Goiás (GO)</option>
                                    <option value="Maranhão (MA)">Maranhão (MA)</option>
                                    <option value="Mato Grosso (MT)">Mato Grosso (MT)</option>
                                    <option value="Mato Grosso do Sul (MS)">Mato Grosso do Sul (MS)</option>
                                    <option value="Minas Gerais (MG)">Minas Gerais (MG)</option>
                                    <option value="Pará (PA)">Pará (PA)</option>
                                    <option value="Paraíba (PB)">Paraíba (PB)</option>
                                    <option value="Paraná (PR)">Paraná (PR)</option>
                                    <option value="Pernambuco (PE)">Pernambuco (PE)</option>
                                    <option value="Piauí (PI)">Piauí (PI)</option>
                                    <option value="Rio de Janeiro (RJ)">Rio de Janeiro (RJ)</option>
                                    <option value="Rio Grande do Norte (RN)">Rio Grande do Norte (RN)</option>
                                    <option value="Rio Grande do Sul (RS)">Rio Grande do Sul (RS)</option>
                                    <option value="Rondônia (RO)">Rondônia (RO)</option>
                                    <option value="Roraima (RR)">Roraima (RR)</option>
                                    <option value="Santa Catarina (SC)">Santa Catarina (SC)</option>
                                    <option value="São Paulo (SP)">São Paulo (SP)</option>
                                    <option value="Sergipe (SE)">Sergipe (SE)</option>
                                    <option value="Tocantins (TO)">Tocantins (TO)</option>
                                </select>
                            </div>
                            <div>
                                <label for="cidade">Cidade</label>
                                <input  type="text" name="cidade" id="cidade" maxlength="100" required>
                            </div>
                            <div>
                                <label for="Bairro">Bairro</label>
                                <input  type="text" name="bairro" id="bairro" maxlength="100" required>
                            </div>
                            <div>
                                <label for="logradouro">Logradouro</label>
                                <input  type="text" name="logradouro" id="logradouro" maxlength="100" required>
                            </div>
                            <div>
                                <label for="numero">Numero</label>
                                <input  type="text" name="numero" id="numero" maxlength="6" required>
                            </div>
                            <div>
                                <label for="complemento">Complemento (Opcional)</label>
                                <input  type="text" name="complemento" id="complemento" maxlength="200">
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