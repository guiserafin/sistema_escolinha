<?php

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{

    $alunos = new UsuariosController();
    $turma = new TurmasController();

    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_turma = explode("&",$arr_url[1]);
    $arr_id_turma = explode("=", $arr_dados_turma[0]);
    
    $id = $arr_id_turma[1];


    ?>
        <!DOCTYPE html>
        <html lang="en">
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
                    <!-- <li class="menu_left_item menu_left_item_selected">
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
                    </li> -->
                    <li class="menu_left_item">
                        <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/turmas" ?>">Voltar</a>
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
                </div><!--fim menu top-->
                <div class="alunos">
                    <h2>Alunos <?php echo ($turma->list()[$id-1]['nome']) ?></h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Matrícula</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($alunos->listAlunos() as $key => $aluno){
                                    if($aluno['turma_id'] == $id){
                                    ?>
                                    
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><?= $aluno['nome'] ?></td>
                                            <td><?= $aluno['email'] ?></td>
                                            <td><?= $aluno['matricula'] ?></td>
                                        </tr>
                                        
                                    <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </body>
        </html>
    <?php

}


