<?php
use UsuarioModel;
class ProfessoresController{

    public function index() {
        include_once DIR_VIEW .  "/professores.php";
    }
    
    public function create() {
        include_once DIR_VIEW . "/professor_criar.php";
    }

    public function store(){

        $usuario = new UsuarioModel();
        $usuario->cadastrarProfessor($_POST);
    }

    public function professor_editar($id){

        $professor_edit = new UsuarioModel();
        return $professor_edit-> listarUserUnico($id);

    }

    public function professor_excluir($id){

        $professor_del = new UsuarioModel();
        $professor_del->excluirUsuario($id);

    }
}