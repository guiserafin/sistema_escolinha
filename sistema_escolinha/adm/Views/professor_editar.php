<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/professores.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_professor = explode("&",$arr_url[1]);
    $arr_id_professor = explode("=", $arr_dados_professor[0]);
    

    $id = $arr_id_professor[1];
    $dados_professor = new ProfessoresController();

    if($_POST){
        if(count($_POST) == 8){ //POST do endereco eh um array de tamanho 8
            $dados_edit = new EnderecoController();
            $dados_edit->edit($_POST);
        }else{

            $dados_edit = new UsuariosController();
            $dados_edit->edit($_POST);
        }
    }


    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área da Admnistração</title>
            <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/style.css"?>">
            <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/font-awesome.min.css" ?>">
        </head>
        <body>
            <main class="geral-dashboard">
                <!--menu left-->
                <aside class="menu-left">
                    <img src="../assets/images/2.png" alt="Logo sci">
                    <ul>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/professores" ?>">Voltar</a>
                        </li>
                    </ul>
                    <a class="link" style="color: #2d3560; ;" href="<?= DOMINIO_ADM ?>"><i class="fa fa-sign-out icone-sair fa-5x" aria-hidden="true"></i></a>
                </aside>
                <!--fim menu left-->
                <div class="content">
                    <!--menu top-->
                    <div class="menu-top">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <?php 
                            $arr_nome = explode(" ",$_SESSION['nome']); //divir o nome em um array quando separado por espaço
                            echo $arr_nome[0]." ".end($arr_nome);
                        ?>
                        <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                    </div><!--fim menu top-->

                    <div class="content-body">
                        <div class="dados d-flex">
                            <?php
                                $dados = $dados_professor->professor_editar($id);
                                $turmas = new TurmasController();
                            ?>
                            <div class="dados-pessoais">
                                <div class="conteudo-dados-pessoais">
                                    <div class="inputs-dados-pessoais">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?= $dados[0] ?>">
                                            <div>
                                                <label for="nome">Nome</label>
                                                <input  type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" maxlength="200">
                                            </div>
                                            <div>
                                                <label for="idade">Idade</label>
                                                <input  type="number" name="idade" id="idade" value="<?= $dados['idade'] ?>">
                                            </div>
                                            <div>
                                                <label for="nascimento">Nascimento</label>
                                                <input  type="date" name="nascimento" id="nascimento" value="<?= $dados['dataNascimento'] ?>">
                                            </div>
                                            <div>
                                                <label for="email">Email</label>
                                                <input  type="email" name="email" id="email" value="<?= $dados['email'] ?>" maxlength="200">
                                            </div>
                                            <div>
                                                <label for="cpf">CPF</label>
                                                <input  type="text" name="cpf" id="cpf" value="<?= $dados['cpf'] ?>" maxlength="14">
                                            </div>
                                            <div>
                                                <label for="nome">RG</label>
                                                <input  type="text" name="rg" id="rg" value="<?= $dados['rg'] ?>" maxlength="20">
                                            </div>
                                            <div>
                                                <label for="sexo">Sexo</label>
                                                <select name="sexo" id="sexo">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Feminino">Feminino</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="telefone">Telefone</label>
                                                <input  type="text" name="telefone" id="telefone" value="<?= $dados['telefone'] ?>" maxlength="20">
                                            </div>
                                            <div>
                                                <label for="nome_turma">Turma</label>
                                                <select name="nome_turma" id="nome_turma">
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
                                                <button type="submit">Editar</button>
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="dados-pessoais">
                                <div class="conteudo-dados-pessoais">
                                    <div class="inputs-dados-pessoais">
                                        <form action="" method="post">
                                            <input type="hidden" name="endereco_id" value="<?= $dados['endereco_id'] ?>">
                                            <div> 
                                                <label for="cep">CEP</label>
                                                <input  type="text" name="cep" id="cep" value="<?=$dados['cep'] ?>" maxlength="9">
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
                                                <input  type="text" name="cidade" id="cidade" value="<?= $dados['cidade'] ?>" maxlength="200">
                                            </div>
                                            <div>
                                                <label for="Bairro">Bairro</label>
                                                <input  type="text" name="bairro" id="bairro" value="<?= $dados['bairro']?>" maxlength="200">
                                            </div>
                                            <div>
                                                <label for="logradouro">Logradouro</label>
                                                <input  type="text" name="logradouro" id="logradouro" value="<?= $dados['logradouro'] ?>" maxlength="200">
                                            </div>
                                            <div>
                                                <label for="numero">Numero</label>
                                                <input  type="text" name="numero" id="numero" value="<?= $dados['numero'] ?>" maxlength="6">
                                            </div>
                                            <div>
                                                <label for="complemento">Complemento</label>
                                                <input  type="text" name="complemento" id="complemento" value="<?= $dados['complemento'] ?>" maxlength="200">
                                            </div>
                                            <div>
                                                <button type="submit">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--fim dados-endereco-->
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}