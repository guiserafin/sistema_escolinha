<?php

class AvaliacoesController
{

    public function index(){
        include_once DIR_VIEW . '/avaliacoes.php';
    }

    public function create(){
        include_once DIR_VIEW . '/avaliacao_criar.php';
    }

    public function store(){


        $avaliacao_create = new AvaliacoesModel();
        $avaliacao_create->criarAvaliacao($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    public function list(){

        $avaliacoes_listar = new AvaliacoesModel();
        return $avaliacoes_listar->listarAvaliacoes();

    }

    public function list_unico($id){

        $avaliacao_listar = new AvaliacoesModel();
        return $avaliacao_listar->listarUmaAvaliacao($id);

    }

    public function edit($id) {
        $_GET['id'] = $id;
        include_once DIR_VIEW . '/avaliacao_editar.php';
    }

    public function update(){
        
        $avaliacao_edit = new AvaliacoesModel();
        $avaliacao_edit->editarAvaliacao($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function delete($id){
        $avaliacao_delete = new AvaliacoesModel();
        $avaliacao_delete->deletarAvaliacao($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

}