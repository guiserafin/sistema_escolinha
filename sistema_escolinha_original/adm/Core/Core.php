<?php

class Core{

    public function index($controller, $metodo, $parametro){
 
        $controllerFile = ucfirst($controller . "Controller");

        $caminho        = file_exists("/var/www/html/Controllers/".$controllerFile.".php"); //true/false

        //var_dump($controllerFile); //Controller
        //var_dump($caminho); //false
        //var_dump($controller); //" "
        //var_dump($metodo);//null
        //var_dump($parametro); //null

        if($caminho){

            if(class_exists($controllerFile)){
               
                if($metodo != ""){

                    switch($metodo){

                        case "criar":
                            $metodo = "create";
                            break;
                        case "aluno_editar":
                            $metodo = "aluno_editar";
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