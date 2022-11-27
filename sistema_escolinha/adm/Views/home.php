<?php

if(!defined('C7E3L8K9E58743')){

    include_once "/var/www/html/Views/home.php";

}else{

    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Academia SCI</title>
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/style.css"?>">
        <link rel="stylesheet" href="<?php echo DOMINIO_ADM . "/assets/css/font-awesome.min.css" ?>">
        <link rel="shortcut icon" href="../assets/images/2.png" type="image/x-icon">
    </head>
    <body>
        <div class="geral">
            <header class="logo">
                <img src="../assets/images/2.png" alt="Logo SCI">
            </header>

            <section class="titulo">
                <h2>Area da Admnistração</h2>
            </section>
            <section class="form-login">
                <form class="login" method="post" action="" id="form_login">
                    <div>
                        <label for="email">Email</label>
                    </div>
                    <div class="email-input">
                        <input type="email" name="email" id="email">
                        <p class="span-error d-none" id="span_error_email">É necessário preencher o e-mail corretamente!</p>
                    </div>
                    <div>
                        <label for="senha">Senha</label>
                    </div>
                    <div>
                        <input type="password" name="senha" id="senha">
                        <p class="span-error d-none" id="span_error_senha">É necessário preencher a senha corretamente!</p>
                    </div>
                    <div>
                        <button id="btn_login" type="button">Entrar</button>
                    </div>
                </form>
                <!-- <p>Não possui cadastro? <a style="color:rgb(135, 145, 226)" class="link" href="../Views/cadastro.php">Clique aqui</a></p> -->
            </section>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script>
            //$ = jquery
            $(document).ready(function (){
                $('#btn_login').click(function(){
                    const email = $('#email').val();
                    const senha = $('#senha').val();

                    $('#email').blur(function(){
                        if(this != ''){
                            $('#span_error_email').addClass('d-none');
                            $('#invalid').addClass('d-none');
                        }
                    });

                    $('#senha').blur(function(){ //blur = saida
                        if(this != ''){ //this == $('#senha')
                            $('#span_error_senha').addClass('d-none');
                            $('#invalid').addClass('d-none');
                        }
                    });

                    if(email == '' || email == null){
                        $('#span_error_email').removeClass('d-none');
                    }else if(senha == '' || senha == null){
                        $('#span_error_senha').removeClass('d-none');
                    }else{
                        $('#form_login').submit();
                    }
                });
            });
        </script>
    </body>
    </html>
    <?php
}

