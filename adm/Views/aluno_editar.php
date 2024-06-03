<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{

    $id = $_GET['id'];
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
            <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/font-awesome.min.css" ?>"><link rel="shortcut icon" href="../assets/images/2.png" type="image/x-icon">
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
                                        <form action="<?php echo DOMINIO_ADM . "/usuarios/update" ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $dados[0] ?>">
                                            <div>
                                                <label for="nome">Nome</label>
                                                <input  type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" maxlength="200" required>
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
                                                <label for="endereco">Endereço (CEP)</label>
                                                <input  type="text" name="endereco" id="endereco" value="<?= $dados['endereco'] ?>" maxlength="20" required>
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
                                                            <option value="<?= $turma['id'] ?>" <?= ($dados['nome_turma'] == $turma['nome'])? "selected":"" ?>>
                                                                <?php echo $turma['nome'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="matricula">Matrícula</label>
                                                <input  type="text" name="matricula" id="matricula" value="<?= $dados['matricula'] ?>" maxlength="10">
                                            </div>
                                            <div>
                                                <button type="submit">Editar</button>
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </body>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
        <script>
            $("#cpf").mask('000.000.000-00');
            $("#telefone").mask("(00)00000-0000");
            $("#endereco").mask("00000-000");
        </script>
        </html>
    <?php
}

