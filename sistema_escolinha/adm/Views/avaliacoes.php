<?php

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    
    $avaliacoes = new AvaliacoesController();

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
                            <a class="link menu_left_link" href="./dashboard">Alunos</a>
                        </li>
                        <li class="menu_left_item ">
                            <a class="link menu_left_link" href="./professores">Professores</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./endereco">Endereços</a>
                        </li>
                        <li class="menu_left_item ">
                            <a class="link menu_left_link" href="./turmas">Turmas</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./cursos">Cursos</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./disciplinas">Disciplinas</a>
                        </li>
                        <li class="menu_left_item menu_left_item_selected">
                            <a class="link menu_left_link" href="./avaliacoes">Avaliações</a>
                        </li>
                    </ul>
                    <a class="link" style="color: #2d3560; ;" href="./home.php"><i class="fa fa-sign-out icone-sair fa-5x" aria-hidden="true"></i></a>
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

                    <div class="content-body p-2">
                        <div class="cadastrar">
                            <a class="link" href="<?php echo DOMINIO_ADM . "/cursos/curso_criar" ?>">Cadastrar avaliação</a>
                        </div>
                        <?php $avaliacoes->list() ?>
                        <table class="tabela-cursos">
                            <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col">Nome Avaliação</th>
                                    <th scope="col">Curso [id]</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($avaliacoes->list() as $key => $avaliacao){
                                   ?>
                                        <tr>
                                            <th scope="row"><?= $avaliacao['id']?></th>
                                            <td><?= $avaliacao['nome']?></td>
                                            <td><?= $avaliacao['disciplina_id']?></td>
                                            <td><?= date("d/m/Y",strtotime($avaliacao['data']))?></td>
                                            <td>
                                                <a href="<?php echo DOMINIO_ADM . '/cursos/curso_editar?id=' . $avaliacao[0] . '&editar=true' ?>">Editar</a>
                                                <a href="<?php echo DOMINIO_ADM . '/cursos/curso_excluir?id=' . $avaliacao[0] . '&excluir=true' ?>">Excluir</a>
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

