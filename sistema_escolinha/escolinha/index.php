<?php

define('C7E3L8K9E58743', true);

$url = filter_input(INPUT_GET,'url',FILTER_DEFAULT);

$arr_url = explode("/",$url);


//Core
include_once "./Core/Core.php";
//Config
include_once "./Config/config.php";
//Controllers
include_once "./Controllers/CadastroController.php";
include_once "./Controllers/ConnectionController.php";
include_once "./Controllers/DashboardController.php";
include_once "./Controllers/UsuarioController.php";
//Models
include_once "./Models/UsuarioModel.php";



$controller = $arr_url[0];
$metodo = $arr_url[1];
$parametro = $arr_url[2];

$index = new Core();
$index->index($controller, $metodo, $parametro);


$email = trim(filter_input(INPUT_POST,'email',FILTER_DEFAULT));
$senha = trim(filter_input(INPUT_POST,'senha',FILTER_DEFAULT));

if (!empty($email) && !empty($senha)){

    $usuario = new UsuarioController();
    
    
    if($usuario->login($email, $senha) == 1){

        header('Location: '.DOMINIO.'/dashboard');

    }else{
        include_once "index.php";
    }
    
}else{
    include_once "index.php";
}

