<?php

class CursosController{

    public function index(){
        include_once DIR_VIEW . '/cursos.php';
    }

    public function create() {
        include_once DIR_VIEW . '/curso_criar.php';
    }
    
    public function list($id = null){ //lista todos os cursos

        if (!$id){
            $cursos_list = new CursosModel();
            return $cursos_list->listarCursos();
        } else {
            $_GET['id'] = $id;
            include_once DIR_VIEW . '/disciplinas_listar.php';
        }

    }
    
    public function list_unico($id){ //lista um curso

        $curso_dados = new CursosModel();
        return $curso_dados-> listarDisciplinasDoCurso($id);

    }
    
    public function listUmCurso($id){
        
        $curso_dados = new CursosModel();
        return $curso_dados->listCursoUnico($id);

    }

    public function edit($id){
        $_GET['id'] = $id;
        include_once DIR_VIEW . '/curso_editar.php';
    }

    public function update(){
        $curso = new CursosModel();
        $curso->editarCurso($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function store(){

        $curso_create = new CursosModel();
        $curso_create->criarCurso($_POST);

        include_once DIR_VIEW . '/curso_criar.php';

    }

    public function delete($id){

        $curso_delete = new CursosModel();
        $curso_delete->deletarCurso($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

}