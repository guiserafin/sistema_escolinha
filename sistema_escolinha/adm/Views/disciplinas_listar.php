<?php
session_start();

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_curso = explode("&",$arr_url[1]);
    $arr_id_curso = explode("=", $arr_dados_curso[0]);
    
    $id = $arr_id_curso[1];
    $disciplinas = new CursosController();

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
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/cursos" ?>">Voltar</a>
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
                        <div class="cadastrar">
                            <a class="link" href="<?php echo DOMINIO_ADM . "/disciplinas/historico_criar?id=" . $id . "&criar=true"?>">Adicionar disciplina</a>
                        </div>
                        <table class="tabela-cursos">
                                <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nome Disciplina</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($disciplinas->list_unico($id) as $key => $disciplina){
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $disciplina['id_disciplina']?></td>
                                            <td><?= $disciplina['nome_disciplina']?></td>
                                            <td><a class="link" href="<?php echo DOMINIO_ADM . "/cursos/disciplina_remover?disciplina_id=".$disciplina['id_disciplina']."?curso_id=".$disciplina['curso_id']?>">Remover</a></td>
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