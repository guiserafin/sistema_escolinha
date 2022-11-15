<?php

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $professores = new UsuariosController();

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
                        <li class="menu_left_item menu_left_item_selected">
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
                    <?php
                            if(count($professores->listProfessores()) > 0){

                                foreach($professores->listProfessores() as $key => $professor){
                                    ?>
                                    <table>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>CPF</th>
                                            <th>RG</th>
                                            <th>Sexo</th>
                                            <th>Telefone</th>
                                            <th>Turma</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $professor['nome'] ?></td>
                                            <td><?php echo $professor['email'] ?></td>
                                            <td><?php echo $professor['cpf'] ?></td>
                                            <td><?php echo $professor['rg'] ?></td>
                                            <td><?php echo ucfirst($professor['sexo']) ?></td>
                                            <td><?php echo $professor['telefone'] ?></td>
                                            <td><?php echo $professor['nome_turma'] ?></td>
                                        </tr>
                                    </table>
                                    <div class="content-body-options">
                                        <a href="<?php echo DOMINIO_ADM . "/dashboard/professor_editar?id=" . $professor[0] . "&editar=true" ?>">Editar</a>
                                        <a href="<?php echo DOMINIO_ADM . "/dashboard/professor_excluir?id=". $professor[0] . "&excluir=true"?>">Excluir</a>
                                    </div>
                                    <?php
                                }
                            }else{
                                echo "Não há professores cadastrados";
                            }
                        ?>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}

