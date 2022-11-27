<?php

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $turmas = new TurmasController();
    $cursos = new CursosController();
    

    if($_POST){
        $nome_turma = $_POST['nome'];
        $nome_curso = $_POST['curso'];

        $turmas->create($nome_turma,$nome_curso);

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
                        <!-- <li class="menu_left_item">
                            <a class="link menu_left_link" href="./dashboard">Alunos</a>
                        </li>
                        <li class="menu_left_item ">
                            <a class="link menu_left_link" href="./professores">Professores</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./endereco">Endereços</a>
                        </li>
                        <li class="menu_left_item menu_left_item_selected">
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
                        <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                    </div><!--fim menu top-->

                    <div class="content-body-turmas-cadastrar p-2">
                        <div class="card-cadastro">
                            <form action="" method="post">
                                <div>
                                    <div><label for="nome">Nome da turma</label></div>
                                    <input type="text" name="nome" id="nome">
                                </div>
                                <div>
                                    <div><label for="curso">Curso</label></div>
                                    <select name="curso" id="curso">
                                        <?php
                                            foreach($cursos->list() as $key => $curso){
                                                ?>
                                                    <option value="<?= $curso['nome'] ?>"><?= $curso['nome'] ?></option>
                                                <?php
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}

