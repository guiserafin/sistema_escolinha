<?php

class NotasController
{

    public function create($dados){

        $notas_create = new NotasModel();
        $notas_create -> cadastrarNota($dados);

    }

    public function list(){

        $notas_listar = new NotasModel();
        return $notas_listar->listarNotas();

    }

    public function list_unico($id){

        $nota_list = new NotasModel();
        return $nota_list->listarUmaNota($id);

    }

    public function edit($dados){

        $nota_edit = new NotasModel();
        $nota_edit->editarNota($dados);
    }

    public function delete($id){
        
        $nota_delete = new NotasModel();
        $nota_delete->deletarNota($id);
        
    }
}