<?php

if(!defined('C7E3L8K9E58743')){
    include_once "/var/www/html/Views/home.php";
}else{
    $professores = new UsuariosController();

    ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Área da Admnistração</title>
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        </head>
        <body>
            <main class="geral-dashboard">
                <!--menu left-->
                <aside class="menu-left">
                    <img src="../assets/images/2.png" alt="Logo sci">
                    <ul>
                        <li class="menu_left_item">
                            <a class="link menu_left_link" href="./dashboard">Alunos</a>
                        </li>
                        <li class="menu_left_item menu_left_item_selected">
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
                    <a class="link" style="color: rgb(227, 227, 1); ;" href="./home.php"><i class="fa fa-sign-out icone-sair fa-5x" aria-hidden="true"></i></a>
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

                    <div class="content-body p-2">
                        <?php
                            if(count($professores->listProfessores()) > 0){

                                foreach($professores->listProfessores() as $key => $professor){

                                    echo "Nome: ". $professor['nome'] . "<br/>";
                                    echo "Idade: ".$professor['idade']. "<br/>";
                                    echo "Data de Nascimento: ".date('d-m-Y', strtotime($professor['dataNascimento']))."<br/>"; 
                                    echo "Email: ". $professor['email']. "<br/>";
                                    echo "CPF: ".$professor['cpf']. "<br/>";
                                    echo "RG: ".$professor['rg']. "<br/>";
                                    echo "Sexo: ".$professor['sexo']. "<br/>";
                                    echo "Telefone: ".$professor['telefone']. "<br/>";
                                    echo "CEP: " .$professor['cep']. "<br/>";
                                    echo "UF: " .$professor['uf'] . "<br/>";
                                    echo "Cidade: " .$professor['cidade']."<br/>";
                                    echo "Bairro: " .$professor['bairro'] ."<br/>";
                                    echo "Logradouro: ".$professor['logradouro']."<br/>";
                                    if($professor['complemento'] != '' && $professor['complemento']!= null){
                                        echo "Complemento: " .$professor['complemento']."<br/>";
                                    }
                                    //FALTA O ECHO DO ENDEREÇO (FAZER COM INNER JOIN)
                                    ?>
                                    <a href="">Editar</a>
                                    <a href="">Excluir</a>
                                    <?php
                                    echo "<hr/>";
                                    ?>
                                    <?php
                                }

                            }
                        ?>
                    </div>
                </div>
            </main>
        </body>
        </html>
    <?php
}
