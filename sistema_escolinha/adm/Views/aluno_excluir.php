<?php
session_start();
if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/dashboard.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_aluno = explode("&",$arr_url[1]);

    $arr_id_aluno = explode("=", $arr_dados_aluno[0]);
    
    $id = $arr_id_aluno[1];

    $dados_aluno = new DashboardController();

    if($_POST){

        $aluno_delete = new UsuariosController();
        $aluno_delete->delete($_POST['id']);

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
                        <a class="link menu_left_link" href="<?php echo DOMINIO_ADM . "/dashboard" ?>">Voltar</a>
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
                        }
                    ?>
                </div><!--fim menu top-->

                <div class="content-body-excluir">
                    <div class="dados-excluir" id="dados_excluir">
                        <div class="dados-excluir-itens">
                            <?php
                                $dados = $dados_aluno->aluno_show_excluir($id);
                            ?>
                            <p>Deseja excluir o usuário <?php echo $dados['nome'] ?>?</p>
                            <form style="display:inline-block" action="" method="post">
                                <input type="hidden" name="id" value="<?= $dados[0] ?>">
                                <button id="btn_confirmar" type="submit">Confirmar</button>
                            </form>
                            <button><a class="link" href="./">Cancelar</a></button>
                        </div>
                </div>
            </div>
        </main>
        <?php
        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        ?>
            <script>
                let confirmacao = document.getElementById('dados_excluir');
                confirmacao.classList.add('d-none');
            </script>
        <?php
        }
        ?>
    </body>
    </html>
<?php
 
}
