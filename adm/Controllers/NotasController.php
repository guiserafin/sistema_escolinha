<?php

class NotasController
{

    public function index(){
        include_once DIR_VIEW . '/notas.php';
    }

    public function create() {
        include_once DIR_VIEW . '/nota_criar.php';
    }

    public function store(){

        $notas_create = new NotasModel();
        $notas_create->cadastrarNota($_POST);
        header("Location: " . $_SERVER['HTTP_REFERER']);

    }

    public function list(){

        $notas_listar = new NotasModel();
        return $notas_listar->listarNotas();

    }

    public function list_unico($id){

        $nota_list = new NotasModel();
        return $nota_list->listarUmaNota($id);

    }

    public function edit($id){
        $_GET['id'] = $id;
        include_once DIR_VIEW . "/nota_editar.php";
    }

    public function update(){

        $nota_edit = new NotasModel();
        $nota_edit->editarNota($_POST);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function delete($id){
        
        $nota_delete = new NotasModel();
        $nota_delete->deletarNota($id);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        
    }
}