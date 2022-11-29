<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['nome']) && !isset($_SESSION['cpf']) && !isset($_SESSION['nivelAcesso_id']) && !isset($_SESSION['situacao_id'])){
    include_once "/var/www/html/Views/home.php";
}else{
    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área do Aluno</title>
            <link rel="stylesheet" href="<?php echo DOMINIO . "/assets/css/style.css"?>">
            <link rel="stylesheet" href="<?php echo DOMINIO . "/assets/css/font-awesome.min.css"?>">
        </head>
        <body>
            <main class="geral-dashboard">
                <!--menu left-->
                <aside class="menu-left">
                    <img src="../assets/images/2.png" alt="Logo sci">
                    <ul>
                        <li class="menu_left_item menu_left_item_selected">
                            <a class="link menu_left_link" href="./dashboard">Início</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./professores">Professores</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./endereco">Turma</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./cursos">Curso</a>
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
                            $arr_nome = explode(" ",$_SESSION['nome']);
                            echo $arr_nome[0]." ".end($arr_nome);
                        ?>
                        <i class="fa fa-cog" aria-hidden="true"></i>

                    </div><!--fim menu top-->

                    <div class="content-body">
                        <div class="dados-aluno">
                            Dados do aluno
                        </div>
                        <div class="nao-sei">
                            Nao sei
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}

