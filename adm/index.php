<?php

define('C7E3L8K9E58743', true);

$url = filter_input(INPUT_GET,'url',FILTER_DEFAULT);

$arr_url = explode("/",$url);


//Core
include_once "./Core/Core.php";
//Config
include_once "./Config/config.php";
//Controllers
include_once "./Controllers/AvaliacoesController.php";
include_once "./Controllers/ConnectionController.php";
include_once "./Controllers/CursosController.php";
include_once "./Controllers/DashboardController.php";
include_once "./Controllers/DisciplinasController.php";
include_once "./Controllers/EnderecoController.php";
include_once "./Controllers/HistoricoController.php";
include_once "./Controllers/HomeController.php";
include_once "./Controllers/NotasController.php";
include_once "./Controllers/UsuariosController.php";
include_once "./Controllers/TurmasController.php";
include_once "./Controllers/ProfessoresController.php";


//Models
include_once "./Models/UsuarioModel.php";
include_once "./Models/CursosModel.php";
include_once "./Models/DisciplinasModel.php";
include_once "./Models/TurmasModel.php";
include_once "./Models/EnderecoModel.php";
include_once "./Models/HistoricoModel.php";
include_once "./Models/AvaliacoesModel.php";
include_once "./Models/NotasModel.php";



$controller = $arr_url[0];
$metodo = $arr_url[1];
$parametro = $arr_url[2];

$index = new Core();
$index->index($controller, $metodo, $parametro);


$email = trim(filter_input(INPUT_POST,'email',FILTER_DEFAULT));
$senha = trim(filter_input(INPUT_POST,'senha',FILTER_DEFAULT));

if (!empty($email) && !empty($senha)){

    $usuario = new UsuariosController();
    if($usuario->login($email, $senha) == 1){
        
        header('Location: ' . DOMINIO_ADM . '/dashboard');

    }else{
        include_once "index.php";
    }
    
}else{
    include_once "index.php";
}

