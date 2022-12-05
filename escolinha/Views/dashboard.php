<?php
session_start();
if(!isset($_SESSION['id']) && !isset($_SESSION['nome']) && !isset($_SESSION['cpf']) && !isset($_SESSION['nivelAcesso_id']) && !isset($_SESSION['situacao_id'])){
    include_once "/var/www/html/Views/home.php";
}else{
    $avaliacoes = new AvaliacoesController();
    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área do Aluno</title>
            <link rel="stylesheet" href="<?= DOMINIO . "/assets/css/style.css"?>">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
            <link rel="stylesheet" href="<?= DOMINIO . '/assets/js/FullCalendar/main.min.css'?>">
        </head>
        <body>
            <main class="geral-dashboard">
                <!--menu left-->
                <aside class="menu-left">
                    <img src="../assets/images/2.png" alt="Logo sci">
                    <ul>
                        <li class="menu_left_item menu_left_item_selected">
                            <a class="link menu_left_link" href="<?=DOMINIO. '/dashboard'?>"> Início</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?=DOMINIO."/turma"?>">Turma</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?=DOMINIO."/curso"?>">Curso</a>
                        </li>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="<?=DOMINIO."/notas"?>">Notas</a>
                        </li>
                        <li>
                            <a class="link" style="color: #2d3560" href="./dashboard/aluno_editar"><i class="fa fa-cog fa-5x" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a class="link" style="color: #2d3560; ;" href="<?=DOMINIO?>"><i class="fa fa-sign-out  fa-5x" aria-hidden="true"></i></a>
                        </li>
                    </ul>
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
                        

                    </div><!--fim menu top-->

                    <div class="content-body">
                        <div class="calendario">
                            
                        </div>
                        <div class="avaliacoes">
                            <table class="tabela">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome Avaliação</th>
                                        <th scope="col">Disciplina</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($avaliacoes->list($_SESSION['turma_id']) as $key => $avaliacao){
                                    ?>
                                        <tr>     
                                            <td><?= $avaliacao['nome']?></td>
                                            <td><?= $avaliacao['nome_disciplina']?></td>
                                            <td><?= date("d/m/Y",strtotime($avaliacao['data']))?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        <script src="<?= DOMINIO . '/assets/js/FullCalendar/main.min.js'?>"></script>
        <script>
            (function(win,doc){
                'use strict';

                let calendarEl = doc.querySelector('.calendario');
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'pt-br',
                    buttonText:{
                        today: 'hoje'
                    },
                    events:
                    [
                        <?php
                        foreach($avaliacoes->list($_SESSION['turma_id']) as $key => $avaliacao){
                            ?>
                        {
                            title: '<?=$avaliacao['nome']?>',
                            start: '<?=$avaliacao['data']?>',
                            end: '<?=$avaliacao['data']?>'
                        },
                        <?php
                        }
                        ?>
                    ]
                });

                calendar.render();

            })(window,document);
        </script>
        </html>
    <?php
    //src="<?=DOMINIO . '/assets/js/script.js'
}

