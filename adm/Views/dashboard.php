<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['nome']) && !isset($_SESSION['cpf']) && !isset($_SESSION['nivelAcesso_id']) && !isset($_SESSION['situacao_id'])){
    include_once "/var/www/html/Views/home.php";
}else{
    $alunos = new UsuariosController();
    
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
                        <li class="menu_left_item menu_left_item_selected">
                            <a class="link menu_left_link" href="./dashboard">Alunos</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./professores">Professores</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./turmas">Turmas</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./cursos">Cursos</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./disciplinas">Disciplinas</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./avaliacoes">Avaliações</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./notas">Notas</a>
                        </li>
                    </ul>
                    <a class="link" style="color: #2d3560; ;" href="<?= DOMINIO_ADM?>"><i class="fa fa-sign-out icone-sair fa-5x" aria-hidden="true"></i></a>
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

                    </div><!--fim menu top-->

                    <div class="content-body">
                        <div class="cadastrar">
                            <h2>Alunos Cadastrados</h2>
                            <a class="link" href="<?php echo DOMINIO_ADM . "/usuarios/create/aluno"?>">Cadastrar Aluno</a>
                        </div>
                        <table class="tabela-cursos">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Telefone</th>
                                    <th>Turma</th>
                                    <th>Matrícula</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($alunos->list(2) as $key => $aluno){
                                   ?>
                                        <tr>
                                            <td><?= $aluno['nome'] ?></td>
                                            <td><?= $aluno['email'] ?></td>
                                            <td><?= $aluno['cpf'] ?></td>
                                            <td><?= $aluno['rg'] ?></td>
                                            <td><?= $aluno['telefone'] ?></td>
                                            <td><?= $aluno['nome_turma']?></td>
                                            <td><?= $aluno['matricula'] ?></td>
                                            <td>
                                                <a href="<?php echo DOMINIO_ADM . "/usuarios/edit/" . $aluno['id'] ?>">Editar</a>
                                                <a href="<?php echo DOMINIO_ADM . "/usuarios/delete/". $aluno['id']?>">Excluir</a>
                                            </td>
                                        </tr>
                                   <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}

