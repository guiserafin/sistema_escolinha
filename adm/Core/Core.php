<?php

class Core{

    public function index($controller, $metodo, $parametro){
 
        $controllerFile = ucfirst($controller . "Controller");

        $caminho        = file_exists("/var/www/html/Controllers/".$controllerFile.".php");

        // var_dump($controllerFile, $caminho, $metodo);

        // var_dump($caminho, $controller, $metodo, $parametro);

        if($caminho){

            if(class_exists($controllerFile)){
               
                if($metodo != ""){

                    call_user_func_array(array(new $controllerFile, $metodo), array($parametro));

                }else{

                    $metodo = 'index';

                    call_user_func_array(array(new $controllerFile, $metodo), array($parametro));

                }

            }else{
                echo "Não existe classe";
            }
        }else{
            include_once "/var/www/html/Views/home.php";
        }
    }
}