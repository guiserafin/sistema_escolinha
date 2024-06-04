<?php
session_start();

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{

    $id = $_GET['id'];

    $nota = new NotasController();
    $dados_nota = $nota->list_unico($id);


    $avaliacoes = new AvaliacoesController();


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
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/notas" ?>">Voltar</a>
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
                            <form action="<?php echo DOMINIO_ADM . '/notas/update' ?>" method="post">
                                <div>
                                    <div><label>Editar nota do aluno <?= $dados_nota['nome_usuario'] ?>?</label></div>
                                </div>
                                <div>
                                    <div><label for="id_avaliacao">Avaliação</label></div>
                                    <input type="hidden" name="id_nota" id="id_nota" value="<?=$id?>">
                                    <select name="id_avaliacao" id="id_avaliacao">
                                        <?php
                                        foreach($avaliacoes->list() as $key => $avaliacao){
                                            ?>
                                            <option value="<?= $avaliacao['id'] ?>"><?= $avaliacao['nome'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <div><label for="nota">Nota</label></div>
                                    <input value="<?=$dados_nota['nota'] ?>" type="number" step="0.1" name="nota" id="nota" required min="0" max="10">
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