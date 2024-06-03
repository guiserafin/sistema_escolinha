<?php

class TurmasController{
    
    public function index() {
        include_once DIR_VIEW . '/turmas.php';
    }

    public function create() {
        include_once DIR_VIEW . '/turma_criar.php';
    }

    public function store(){
        
        $turma_create = new TurmasModel();
        return $turma_create->criarTurma($_POST);
    }

    public function list($id = null){
        $turmas = new TurmasModel();

        if ($id == null) {
            return $turmas->listarTurmas();
        } else {

            // return $turmas->listarTurmaUnica($id);
            $_GET['id'] = $id;
            include_once DIR_VIEW . '/turmas_listar.php';

        }

    }

    public function list_unico($id){

        $turmas_listUnico = new TurmasModel();
        return $turmas_listUnico->listarTurmaUnica($id);

    }
    
    public function delete($id){

        $turma_delete = new TurmasModel();
        $turma_delete->deletarTurma($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    public function edit($id){
        $_GET['id'] = $id;
        include_once DIR_VIEW . '/turma_editar.php';

    }

    public function update(){
        $turma_edit = new TurmasModel();

        var_dump($_POST);

        $turma_edit->editarTurma($_POST['id'], $_POST['curso'],$_POST['nome']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}