<?php
session_start();

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{

    $arr_url = explode("?" ,$_SERVER['REQUEST_URI']);
    $arr_url_id = explode("&", $arr_url[1]);
    $arr_id = explode("=", $arr_url_id[0]);
    
    $id = $arr_id[1];
    $disciplina = new DisciplinasController();
    $disciplina_dados = $disciplina->list_unico($id)[0];


    if($_POST){
        
        $nome = $_POST['disciplina'];
        $disciplina->edit($nome, $id);
    }

    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área da Administração</title>
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
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/disciplinas" ?>">Voltar</a>
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
                    <div class="content-body-turmas-cadastrar">
                        <div class="card-curso">
                            <form action="" method="post">
                                <div>
                                    <div><label for="disciplina">Nome da disciplina</label></div>
                                    <input type="text" name="disciplina" id="disciplina" value="<?= $disciplina_dados['nome'] ?>">
                                </div>
                                <div>
                                    <button type="submit">Editar</button>
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