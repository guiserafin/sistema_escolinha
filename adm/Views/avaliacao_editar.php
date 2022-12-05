<?php
session_start();

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_avaliacao = explode("&",$arr_url[1]);
    $arr_id_avaliacao = explode("=", $arr_dados_avaliacao[0]);
    
    $id = $arr_id_avaliacao[1];
    
    $avaliacao = new AvaliacoesController();
    $disciplinas = new DisciplinasController();
    $turmas = new TurmasController();
    if($_POST){

        $avaliacao->edit($_POST);
        
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
                            <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/avaliacoes" ?>">Voltar</a>
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
                    <?php
                        $dados_avalicao = $avaliacao->list_unico($id);
                        $dados_disciplinas = $disciplinas->list();
                     ?>
                    <div class="content-body-turmas-cadastrar">
                        <div class="card-curso">
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div>
                                    <div><label for="nome_avaliacao">Nome da avaliação</label></div>
                                    <input type="text" name="nome_avaliacao" id="nome_avaliacao" value="<?= $dados_avalicao['nome']?>" maxlength="50" required>
                                </div>
                                <div>
                                    <div><label for="nome_disciplina">Disciplina</label></div>
                                    <select name="nome_disciplina" id="nome_disciplina">
                                        <?php
                                        foreach($dados_disciplinas as $key => $disciplina){
                                            ?>
                                            <option value="<?=$disciplina['nome']?>" <?= ($dados_avalicao['disciplina_id'] == $disciplina['id'])? "selected": ""?>><?=$disciplina['nome']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <div><label for="id_turma">Turma</label></div>
                                    <select name="id_turma" id="id_turma">
                                        <?php
                                        foreach($turmas->list() as $key => $turma){
                                            ?>
                                            <option value="<?=$turma['id']?>"><?=$turma['nome']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <div><label for="data">Data</label></div>
                                    <input type="date" name="data" id="data" value="<?= $dados_avalicao['data']?>" required>
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