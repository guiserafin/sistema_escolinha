<?php
session_start();

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $arr_url = explode("?", $_SERVER['REQUEST_URI']);
    $arr_dados_curso = explode("&",$arr_url[1]);
    $arr_id_curso = explode("=", $arr_dados_curso[0]);
    
    $id = $arr_id_curso[1];//este é o ID do curso

    $cursos = new CursosController();
    $disciplinas = new DisciplinasController();

    if($_POST){
        $nome_disciplina = $_POST['disciplina'];

        $historico = new HistoricoController();
        $historico->create($id,$nome_disciplina);
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
                    <?php 
                        $dados_curso = $cursos->list_unico($id);
                        
                     ?>
                    <div class="content-body-turmas-cadastrar">
                        <div class="card-curso">
                            <form action="" method="post">
                                <div>
                                    <div><label>Adicionar disciplina ao curso <?php echo $dados_curso[0]['nome_curso'] ?></label></div>
                
                                </div>
                                <div>
                                    <div><label for="disciplina">Disciplinas:</label></div>
                                    <select name="disciplina" id="disciplina">
                                        <?php
                                            foreach($disciplinas->list() as $key => $disciplina){
                                                ?>
                                                    <option><?= $disciplina['nome'] ?></option>
                                                <?php
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
    // array (size=6)
    // 0 => 
    //   array (size=8)
    //     'id' => string '1' (length=1)
    //     0 => string '1' (length=1)
    //     'nome' => string 'PHP' (length=3)
    //     1 => string 'PHP' (length=3)
    //     'dateCreate' => string '2022-11-04 20:27:01' (length=19)
    //     2 => string '2022-11-04 20:27:01' (length=19)
    //     'dateModified' => null
    //     3 => null
    // 1 => 
    //   array (size=8)
    //     'id' => string '2' (length=1)
    //     0 => string '2' (length=1)
    //     'nome' => string 'Javascript' (length=10)
    //     1 => string 'Javascript' (length=10)
    //     'dateCreate' => string '2022-11-04 20:37:05' (length=19)
    //     2 => string '2022-11-04 20:37:05' (length=19)
    //     'dateModified' => null
    //     3 => null
    // 2 => 
    //   array (size=8)
    //     'id' => string '3' (length=1)
    //     0 => string '3' (length=1)
    //     'nome' => string 'Banco de dados' (length=14)
    //     1 => string 'Banco de dados' (length=14)
    //     'dateCreate' => string '2022-11-04 20:37:05' (length=19)
    //     2 => string '2022-11-04 20:37:05' (length=19)
    //     'dateModified' => null
    //     3 => null
    // 3 => 
    //   array (size=8)
    //     'id' => string '4' (length=1)
    //     0 => string '4' (length=1)
    //     'nome' => string 'Delphi' (length=6)
    //     1 => string 'Delphi' (length=6)
    //     'dateCreate' => string '2022-11-04 20:37:28' (length=19)
    //     2 => string '2022-11-04 20:37:28' (length=19)
    //     'dateModified' => null
    //     3 => null
    // 4 => 
    //   array (size=8)
    //     'id' => string '6' (length=1)
    //     0 => string '6' (length=1)
    //     'nome' => string 'teste' (length=5)
    //     1 => string 'teste' (length=5)
    //     'dateCreate' => string '2022-11-17 14:07:00' (length=19)
    //     2 => string '2022-11-17 14:07:00' (length=19)
    //     'dateModified' => null
    //     3 => null
    // 5 => 
    //   array (size=8)
    //     'id' => string '7' (length=1)
    //     0 => string '7' (length=1)
    //     'nome' => string 'teste2' (length=6)
    //     1 => string 'teste2' (length=6)
    //     'dateCreate' => string '2022-11-17 14:07:00' (length=19)
    //     2 => string '2022-11-17 14:07:00' (length=19)
    //     'dateModified' => null
    //     3 => null
  
}