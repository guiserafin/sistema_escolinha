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

                        case "aluno_criar":
                            $metodo = "aluno_criar";
                            break;
                        case "aluno_editar":
                            $metodo = "aluno_editar";
                            break;
                        case "aluno_excluir":
                            $metodo = "aluno_excluir";
                            break;
                        case "professor_editar":
                            $metodo = "professor_editar";
                            break;
                        case "professor_excluir":
                            $metodo = "professor_excluir";
                            break;
                        case "professor_criar":
                            $metodo = "professor_criar";
                            break;
                        case "endereco_editar":
                            $metodo = "endereco_editar";
                            break;
                        case "disciplinas_listar":
                            $metodo = "disciplinas_listar";
                            break;
                        case "curso_criar":
                            $metodo = "curso_criar";
                            break;
                        case "curso_excluir":
                            $metodo = "curso_excluir";
                            break;
                        case "curso_editar":
                            $metodo = "curso_editar";
                            break;
                        case "historico_criar":
                            $metodo = "historico_criar";
                            break;
                        case "endereco_excluir":
                            $metodo = "endereco_excluir";
                            break;
                        case "turma_criar":
                            $metodo = "turma_criar";
                            break;
                        case "turmas_listar":
                            $metodo = "turmas_listar";
                            break;
                        case "turma_editar":
                            $metodo = "turma_editar";
                            break;
                        case "turma_excluir":
                            $metodo = "turma_excluir";
                            break;
                        case "disciplina_criar":
                            $metodo = "disciplina_criar";
                            break;
                        case "disciplina_editar":
                            $metodo = "disciplina_editar";
                            break;
                        case "disciplina_excluir":
                            $metodo = "disciplina_excluir";
                            break;
                        case "disciplina_remover":
                            $metodo = "disciplina_remover";
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