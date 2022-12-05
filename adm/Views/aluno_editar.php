<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_aluno = explode("&",$arr_url[1]);

    if($_POST){

        if(count($_POST) == 8){ //POST do endereco eh um array de tamanho 8
            $dados_edit = new EnderecoController();
            $dados_edit->edit($_POST);
        }else{

            $dados_edit = new UsuariosController();
            $dados_edit->edit($_POST);
        }
    }

    $arr_id_aluno = explode("=", $arr_dados_aluno[0]);
    
    $id = $arr_id_aluno[1];

    $dados_aluno = new DashboardController();
    $turmas = new TurmasController();
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
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/dashboard" ?>">Voltar</a>
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
                                $dados = $dados_aluno->aluno_editar($id);
                            ?>
                            <div class="dados-pessoais">
                                <div class="conteudo-dados-pessoais">
                                    <div class="inputs-dados-pessoais">
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?= $dados[0] ?>">
                                            <div>
                                                <label for="nome">Nome</label>
                                                <input  type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" maxlength="200" required>
                                            </div>
                                            <div>
                                                <label for="idade">Idade</label>
                                                <input  type="number" name="idade" id="idade" value="<?= $dados['idade'] ?>" required>
                                            </div>
                                            <div>
                                                <label for="nascimento">Nascimento</label>
                                                <input  type="date" name="nascimento" id="nascimento" value="<?= $dados['dataNascimento'] ?>" required>
                                            </div>
                                            <div>
                                                <label for="email">Email</label>
                                                <input  type="email" name="email" id="email" value="<?= $dados['email'] ?>" maxlength="200" required>
                                            </div>
                                            <div>
                                                <label for="cpf">CPF</label>
                                                <input  type="text" name="cpf" id="cpf" value="<?= $dados['cpf'] ?>" maxlength="14" required>
                                            </div>
                                            <div>
                                                <label for="nome">RG</label>
                                                <input  type="text" name="rg" id="rg" value="<?= $dados['rg'] ?>" maxlength="20" required>
                                            </div>
                                            <div>
                                                <label for="sexo">Sexo</label>
                                                <select name="sexo" id="sexo">
                                                    <option value="Masculino" <?= ($dados['sexo'] == 'Masculino')? 'selected' : "" ?>>Masculino</option>
                                                    <option value="Feminino" <?= (ucfirst($dados['sexo']) == 'Feminino')? 'selected' : "" ?>>Feminino</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="telefone">Telefone</label>
                                                <input  type="text" name="telefone" id="telefone" value="<?= $dados['telefone'] ?>" maxlength="20" required>
                                            </div>
                                            <div>
                                                <label for="nome_turma">Turma</label>
                                                <select name="nome_turma" id="nome_turma">
                                                    <?php
                                                        foreach($turmas->list() as $key => $turma){
                                                            ?>
                                                            <option value="<?= $turma['nome'] ?>" <?= ($dados['nome_turma'] == $turma['nome'])? "selected":"" ?>>
                                                                <?php echo $turma['nome'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="matricula">Matrícula</label>
                                                <input  type="text" name="matricula" id="matricula" value="<?= $dados['matricula'] ?>" maxlength="10" required>
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
                                                <input  type="text" name="cep" id="cep" value="<?=$dados['cep'] ?>" maxlength="9" required>
                                            </div>
                                            <div>
                                                
                                                <label for="uf">UF</label>
                                                <select name="uf" id="uf">
                                                    <option value="Acre (AC)" <?= ($dados['uf'] == "Acre (AC)")? "selected" : ""?>>Acre (AC)</option>
                                                    <option value="Alagoas (AL)" <?= ($dados['uf'] == "Alagoas (AL)")? "selected" : ""?>>Alagoas (AL)</option>
                                                    <option value="Amapá (AP)" <?= ($dados['uf'] == "Amapá (AP)")? "selected" : ""?>>Amapá (AP)</option>
                                                    <option value="Amazonas (AM)" <?= ($dados['uf'] == "Amazonas (AM)")? "selected" : ""?>>Amazonas (AM)</option>
                                                    <option value="Bahia (BA)" <?= ($dados['uf'] == "Bahia (BA)")? "selected" : ""?>>Bahia (BA)</option>
                                                    <option value="Ceará (CE)" <?= ($dados['uf'] == "Ceará (CE)")? "selected" : ""?>>Ceará (CE)</option>
                                                    <option value="Distrito Federal (DF)" <?= ($dados['uf'] == "Distrito Federal (DF)")? "selected" : ""?>>Distrito Federal (DF)</option>
                                                    <option value="Espírito Santo (ES)" <?= ($dados['uf'] == "Espírito Santo (ES)")? "selected" : ""?>>Espírito Santo (ES)</option>
                                                    <option value="Goiás (GO)" <?= ($dados['uf'] == "Goiás (GO)")? "selected" : ""?>>Goiás (GO)</option>
                                                    <option value="Maranhão (MA)" <?= ($dados['uf'] == "Maranhão (MA)")? "selected" : ""?>>Maranhão (MA)</option>
                                                    <option value="Mato Grosso (MT)" <?= ($dados['uf'] == "Mato Grosso (MT)")? "selected" : ""?>>Mato Grosso (MT)</option>
                                                    <option value="Mato Grosso do Sul (MS)" <?= ($dados['uf'] == "Mato Grosso do Sul (MS)")? "selected" : ""?>>Mato Grosso do Sul (MS)</option>
                                                    <option value="Minas Gerais (MG)" <?= ($dados['uf'] == "Minas Gerais (MG)")? "selected" : ""?>>Minas Gerais (MG)</option>
                                                    <option value="Pará (PA)" <?= ($dados['uf'] == "Pará (PA)")? "selected" : ""?>>Pará (PA)</option>
                                                    <option value="Paraíba (PB)" <?= ($dados['uf'] == "Paraíba (PB)")? "selected" : ""?>>Paraíba (PB)</option>
                                                    <option value="Paraná (PR)" <?= ($dados['uf'] == "Paraná (PR)")? "selected" : ""?>>Paraná (PR)</option>
                                                    <option value="Pernambuco (PE)" <?= ($dados['uf'] == "Pernambuco (PE)")? "selected" : ""?>>Pernambuco (PE)</option>
                                                    <option value="Piauí (PI)" <?= ($dados['uf'] == "Piauí (PI)")? "selected" : ""?>>Piauí (PI)</option>
                                                    <option value="Rio de Janeiro (RJ)" <?= ($dados['uf'] == "Rio de Janeiro (RJ)")? "selected" : ""?>>Rio de Janeiro (RJ)</option>
                                                    <option value="Rio Grande do Norte (RN)" <?= ($dados['uf'] == "Rio Grande do Norte (RN)")? "selected" : ""?>>Rio Grande do Norte (RN)</option>
                                                    <option value="Rio Grande do Sul (RS)" <?= ($dados['uf'] == "Rio Grande do Sul (RS)")? "selected" : ""?>>Rio Grande do Sul (RS)</option>
                                                    <option value="Rondônia (RO)" <?= ($dados['uf'] == "Rondônia (RO)")? "selected" : ""?>>Rondônia (RO)</option>
                                                    <option value="Roraima (RR)" <?= ($dados['uf'] == "Roraima (RR)")? "selected" : ""?>>Roraima (RR)</option>
                                                    <option value="Santa Catarina (SC)" <?= ($dados['uf'] == "Santa Catarina (SC)")? "selected" : ""?>>Santa Catarina (SC)</option>
                                                    <option value="São Paulo (SP)" <?= ($dados['uf'] == "São Paulo (SP)")? "selected" : ""?>>São Paulo (SP)</option>
                                                    <option value="Sergipe (SE)" <?= ($dados['uf'] == "Sergipe (SE)")? "selected" : ""?>>Sergipe (SE)</option>
                                                    <option value="Tocantins (TO)" <?= ($dados['uf'] == "Tocantins (TO)")? "selected" : ""?>>Tocantins (TO)</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="cidade">Cidade</label>
                                                <input  type="text" name="cidade" id="cidade" value="<?= $dados['cidade'] ?>" maxlength="100" required>
                                            </div>
                                            <div>
                                                <label for="Bairro">Bairro</label>
                                                <input  type="text" name="bairro" id="bairro" value="<?= $dados['bairro']?>" maxlength="100" required>
                                            </div>
                                            <div>
                                                <label for="logradouro">Logradouro</label>
                                                <input  type="text" name="logradouro" id="logradouro" value="<?= $dados['logradouro'] ?>" maxlength="100" required>
                                            </div>
                                            <div>
                                                <label for="numero">Numero</label>
                                                <input  type="text" name="numero" id="numero" value="<?= $dados['numero'] ?>" maxlength="6" required>
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

