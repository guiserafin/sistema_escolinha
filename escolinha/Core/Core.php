<?php

class Core{

    public function index($controller, $metodo, $parametro){
 
        $controllerFile = ucfirst($controller . "Controller");

        $caminho        = file_exists("/var/www/html/Controllers/".$controllerFile.".php"); //true/false

        if($caminho){

            if(class_exists($controllerFile)){
               
                if($metodo != ""){

                    switch($metodo){

                        case "aluno_editar":
                            $metodo = "aluno_editar";
                            break;
                        default:
                            include_once "/var/www/html/Views/error404.php";
                                
                    }

                    $controller = new $controllerFile();

                    call_user_func($controller->$metodo, $parametro);
                    
                    include_once "/var/www/html/Views/" . $metodo . ".php";

                }else{

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