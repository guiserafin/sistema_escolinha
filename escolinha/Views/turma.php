<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $professores = new UsuarioController();
    $alunos = new UsuarioController();
    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área do Aluno</title>
            <link rel="stylesheet" href="<?= DOMINIO . "/assets/css/style.css"?>">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
            <link rel="stylesheet" href="<?= DOMINIO . '/assets/js/FullCalendar/main.min.css'?>">
        </head>
        <body>
            <main class="geral-dashboard">
                <!--menu left-->
                <aside class="menu-left">
                    <img src="../assets/images/2.png" alt="Logo sci">
                    <ul>
                        <li class="menu_left_item ">
                            <a class="link menu_left_link" href="<?=DOMINIO. '/dashboard'?>"> Início</a>
                        </li>
                        <li class="menu_left_item menu_left_item_selected">
                            <a class="link menu_left_link" href="<?=DOMINIO."/turma"?>">Turma</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?=DOMINIO."/curso"?>">Curso</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?=DOMINIO."/notas"?>">Notas</a>
                        </li>
                        <li>
                            <a class="link" style="color: #2d3560" href="./dashboard/aluno_editar"><i class="fa fa-cog fa-5x" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a class="link" style="color: #2d3560; ;" href="<?=DOMINIO?>"><i class="fa fa-sign-out  fa-5x" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    
                </aside>
                <!--fim menu left-->
                <div class="content">
                    <!--menu top-->
                    <div class="menu-top">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <?php 
                            $arr_nome = explode(" ",$_SESSION['nome']);
                            echo $arr_nome[0]." ".end($arr_nome);
                        ?>
                    </div><!--fim menu top-->

                    <div style="flex-direction: column;" class="content-body">
                        <div class="professores">
                            <h1>Professores da sua turma</h1>
                            <table class="tabela">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Turma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($professores->listProf($_SESSION['turma_id']) as $key => $professor){
                                    ?>
                                            <tr>     
                                                <td><?= $professor['nome']?></td>
                                                <td><?= $professor['email']?></td>
                                                <td><?= $professor['telefone']?></td>
                                                <td><?= $professor['nome_turma']?></td>
                                            </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="">
                            <h1>Colegas da sua turma</h1>
                            <table class="tabela">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Turma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($alunos->listAlunos($_SESSION['turma_id']) as $key => $aluno){
                                    ?>
                                        <tr>     
                                            <td><?= $aluno['nome']?></td>
                                            <td><?= $aluno['email']?></td>
                                            <td><?= $aluno['telefone']?></td>
                                            <td><?= $aluno['nome_turma']?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        <script src="<?= DOMINIO . '/assets/js/FullCalendar/main.min.js'?>"></script>
        <script src="<?= DOMINIO . '/assets/js/script.js'?>"></script>
        </html>
    <?php
}

