<?php

class Core{

    public function index($controller, $metodo, $parametro){
 
        $controllerFile = ucfirst($controller . "Controller");

        $caminho        = file_exists("/var/www/html/Controllers/".$controllerFile.".php"); //true/false

        if($caminho){

            if(class_exists($controllerFile)){
               
                if($metodo != ""){

                    switch($metodo){

                        case "criar":
                            $metodo = "create";
                            break;
                        case "editar":
                            $metodo = "edit";
                            break;
                        case "deletar":
                            $metodo = "delete";
                            break;
                        case "listar":
                            $metodo = "list";
                            break;
                        default:
                            include_once "/var/www/html/Views/error404.php";
                                
                    }

                    call_user_func_array(array(new $controllerFile, $metodo), $parametro);
                    include_once "/var/www/html/Views/" . $metodo . ".php";

                }else{

                    call_user_func_array(array(new $controllerFile, $metodo),$parametro);
                    include_once "/var/www/html/Views/" . $controller . ".php";

                }

            }else{
                echo "Não existe classe";
            }
        }else{
            include_once "/var/www/html/Views/home.php";
        }
    }
}