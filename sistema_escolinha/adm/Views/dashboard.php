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
                    </ul>
                    <a class="link" style="color: #2d3560; ;" href="./home"><i class="fa fa-sign-out icone-sair fa-5x" aria-hidden="true"></i></a>
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
                        <?php
                            if(count($alunos->listAlunos()) > 0){

                                foreach($alunos->listAlunos() as $key => $aluno){
                                    ?>
                                    <table>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>CPF</th>
                                            <th>RG</th>
                                            <th>Sexo</th>
                                            <th>Telefone</th>
                                            <th>Matrícula</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $aluno['nome'] ?></td>
                                            <td><?php echo $aluno['email'] ?></td>
                                            <td><?php echo $aluno['cpf'] ?></td>
                                            <td><?php echo $aluno['rg'] ?></td>
                                            <td><?php echo ucfirst($aluno['sexo']) ?></td>
                                            <td><?php echo $aluno['telefone'] ?></td>
                                            <td><?php echo $aluno['matricula'] ?></td>
                                        </tr>
                                    </table>
                                    <div class="content-body-options">
                                        <a href="<?php echo DOMINIO_ADM . "/dashboard/aluno_editar?id=" . $aluno['id'] . "&editar=true" ?>">Editar</a>
                                        <a href="<?php echo DOMINIO_ADM . "/dashboard/aluno_excluir?id=". $aluno['id'] . "&excluir=true"?>">Excluir</a>
                                    </div>
                                    <?php
                                }
                            }else{
                                echo "Não há alunos cadastrados";
                            }
                        ?>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}

