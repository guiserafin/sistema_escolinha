<?php

class DisciplinasController{

    public function index(){
        include_once DIR_VIEW . '/disciplinas.php';
    }

    public function list(){

        $disciplinas_list = new DisciplinasModel();
        return $disciplinas_list->listarDisciplinas();

    }

    public function list_unico($id){
        $disciplina_list = new DisciplinasModel();
        return $disciplina_list->listarUmaDisciplina($id);
    }
    
    public function create(){

        include_once "/var/www/html/Views/disciplina_criar.php";
    }

    public function store(){

        $disciplina_create = new DisciplinasModel();
        $disciplina_create->criarDisciplina($_POST['disciplina']);

        include_once  DIR_VIEW . "/disciplina_criar.php";

    }

    public function edit($id){
        $_GET['id'] = $id;
        include_once DIR_VIEW . '/disciplina_editar.php';
    }

    public function update(){

        $disciplina_edit = new DisciplinasModel();
        $disciplina_edit->editarDisciplina($_POST['disciplina'], $_POST['id']);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public function delete($id){
        
        $disciplina_delete = new DisciplinasModel();
        $disciplina_delete->excluirDisciplina($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

}